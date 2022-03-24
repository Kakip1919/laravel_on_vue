<template>
    <div class="hello">
        <h1>
        Video Call<br><small style="font-size: 14pt;">Powered by Agora.io</small>
        </h1>
        <h4>Local video</h4>
        <div id="me"></div>
        <h4>Remote video</h4>
        <div id="container"></div>
    </div>
</template>

<script>
import AgoraRTC from 'agora-rtc-sdk'

export default {
    name: 'agora_web_component',
    mounted() {
        let client = AgoraRTC.createClient({
            mode: "rtc",
            codec: "vp8",
        });
        let localStream = AgoraRTC.createStream({
            audio: false,
            video: false,
        });
        client.init("340dc81b046b499eadf86073d24bbc34");
        client.join(null, ch_name(), null, () => {
            localStream.init(() => {
                localStream.play("me");
                client.publish(localStream, handleError);
            }, handleError);
            client.on("stream-added", function (evt) {
                client.subscribe(evt.stream, handleError);
            });
            client.on("stream-subscribed", function (evt) {
                let stream = evt.stream;
                let streamId = String(stream.getId());
                addVideoStream(streamId);
                stream.play(streamId);
            });
            client.on("stream-removed", function (evt) {
                let stream = evt.stream;
                let streamId = String(stream.getId());
                stream.close();
                removeVideoStream(streamId);
            });
            client.on("peer-leave", function (evt) {
                let stream = evt.stream;
                let streamId = String(stream.getId());
                stream.close();
                removeVideoStream(streamId);
            });
        }, handleError);
    },
}
function ch_name() {
    console.log(document.getElementById("channel_name").value);
    return document.getElementById("channel_name").value
}

const handleError = function (err) {
    console.log("Error: ", err);
};

function addVideoStream(elementId) {
    let streamDiv = document.createElement("div");
    streamDiv.id = elementId;
    streamDiv.style.transform = "rotateY(180deg)";
    streamDiv.style.width = "400px";
    streamDiv.style.height = "400px";
    streamDiv.style.margin = "0 auto";
    document.getElementById("container").appendChild(streamDiv);
}

function removeVideoStream(elementId) {
    let remoteDiv = document.getElementById(elementId);
    if (remoteDiv) remoteDiv.parentNode.removeChild(remoteDiv);
}
</script>

<style scoped>
* {
    font-family: sans-serif;
}

h1, h4 {
    text-align: center;
}

#me {
    width: 400px;
    height: 400px;
    margin: 0 auto;
}

#container video {
    position: relative !important;
}
</style>
