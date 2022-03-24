<template>
    <div class="container">
        <div class="row justify-content-center">
            <slot></slot>
            <h3>やること</h3>
            <div><s>1. 任意のチャンネル発行</s></div>
            <div><s>2. チャンネルリストの表示</s></div>
            <div><s>3. チャンネルへの接続</s></div>
            <div><s>4. チャンネル削除</s></div>
            <div><s>5. チャンネル接続状況確認</s></div>
            <div><s>6. チャンネルへの接続制限（１対１）</s></div>
            <div>7. チャンネル通話経過時間の表示</div>
            <div><s>8. チャンネル接続者リストの表示</s></div>
            <div>9. チャンネル内テキストチャットの設置</div>
            <div>10. チャンネル内テキストチャットへのファイル転送</div>
            <div>11. 通話終了の自動チェック</div>
            <div>12. 待機中チャンネルの自動チェック</div>
            <div>13. 不要チャンネルの自動削除</div>
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
