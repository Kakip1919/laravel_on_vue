<template>
    <div class="container">
        <div class="row justify-content-center">
            <h1>クォンサンウのもくもく会</h1>
            <div class="row">
                <label>メールアドレスを入力してね
                    <input type="email" name="email" class="form-control">
                </label>
                <button type="submit">送信！</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
