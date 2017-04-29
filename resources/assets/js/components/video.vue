<template>
  <video-player  ref="videoPlayer"
                 :options="playerOptions"

                 title="you can listen some event if you need"
                 @play="onPlayerPlay($event)"
                 @pause="onPlayerPause($event)"
                 @ended="onPlayerEnded($event)"
                 @statechanged="playerStateChanged($event)"
                 @ready="playerReadied">
  </video-player>
</template>

<script>
  // Similarly, you can also introduce the plugin resource pack you want to use within the component
  // require('some-videojs-plugin')
  export default {
    created() {
      axios.post('api/getvideo',{
        video : 11
      }).then(response => {
        console.log(this.playerOptions.sources[0].src);
        this.playerOptions.sources[0].src=response.data;
        // console.log(response.data);
      })
    },
    data() {
      return {
        playerOptions: {

          // component options
          start: 0,
          playsinline: false,

          // videojs options
          muted: true,
          language: 'zh_cn',
          playbackRates: [0.7, 1.0, 1.5, 2.0],
          sources: [{
            type: "video/flv",
            src: ""
          }],
          // poster: "/static/images/author.jpg",
        }
      }
    },
    mounted() {
      console.log('this is current player instance object', this.player)
    },
    computed: {
      player() {
        return this.$refs.videoPlayer.player
      }
    },
    methods: {
      // listen event
      onPlayerPlay(player) {
        // console.log('player play!', player)
      },
      onPlayerPause(player) {
        // console.log('player pause!', player)
      },
      // ...player event

      // or listen state event
      playerStateChanged(playerCurrentState) {
        // console.log('player current update state', playerCurrentState)
      },

      // player is ready
      playerReadied(player) {
        console.log('the player is readied', player)
        // you can use it to do something...
        // player.[methods]
      }
    }
  }
</script>
