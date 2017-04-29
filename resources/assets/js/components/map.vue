<template lang="html">
  <div id="demoComponent" class="demo-component">
      <el-amap vid="amap" :zoom="zoom" :center="center" :amapManager="amapManager">
        <el-amap-polyline :editable="polyline.editable"  :path="polyline.path" :events="polyline.events"></el-amap-polyline>
        <div v-for="marker in markers">
        <el-amap-marker  :position="marker.position" :events="marker.events" :visible="marker.visible" :draggable="marker.draggable"></el-amap-marker>
        </div>
      </el-amap>
      <button type="button" name="button" v-on:click="changeEditable">change editable</button>
      <el-dialog title="监控视频" v-model="dialogvideo">
        <video-player  ref="videoPlayer"
                       :options="playerOptions">
        </video-player>
        <el-table
          :data="tableData"
          style="width: 100%">
          <el-table-column
            prop="id"
            label="编号"
            width="180">
          </el-table-column>
          <el-table-column
            prop="start"
            label="开始"
            width="180">
          </el-table-column>
          <el-table-column
            prop="end"
            label="结束">
          </el-table-column>
        </el-table>
      </el-dialog>
  </div>
</template>

<script>
import { AMapManager } from 'vue-amap';
let amapManager = new AMapManager();
const POLYGON_ID = 'POLYGON_ID';
export default {
  name: 'demoComponent',
  computed: {
    player() {
      return this.$refs.videoPlayer.player
    }
  },
  created() {
    axios.get('api/allvideo/1')
          .then(response => {
            let k=response.data;
            let i=0;
            while (k[i]!=null) {
              // console.log(k[i].id);
              let j=k[i].id;
              let marker={
                position: [k[i].lng, k[i].lat],
                events: {
                  click: () => {
                    this.dialogvideo=true;
                    this.tableData=[];
                    axios.get('api/allsmallvideo/'+j).then(response =>{
                      let y = response.data;
                      let u=0;
                      while (y[u]!=null) {
                        this.tableData.push(y[u]);
                        u++;
                      }
                    });
                    axios.post('api/getvideo',{
                      video : 11
                    }).then(response => {
                      console.log(this.playerOptions.sources[0].src);
                      this.playerOptions.sources[0].src=response.data;
                      // console.log(response.data);
                    })
                  },
                },
                visible: true,
                draggable: false
              }
              let polygon=[k[i].lng, k[i].lat]
              console.log(polygon)
              this.polyline.path.push(polygon)
              this.markers.push(marker)
              i=i+1
            }
          })
  },
  data() {
    return {
      tableData:[],
      dialogvideo: false,
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
          src: null,
        }],
        // poster: "/static/images/author.jpg",
      },
      zoom: 12,
      amapManager: amapManager,
      center: [121.5273285, 31.25515044],
      polyline: {
        vid: POLYGON_ID,
        path: [],
        events: {
          click(e) {
            console.log(e);
            alert('click polyline');
          },
          end: (e) => {
            let newPath = e.target.getPath().map(point => [point.lng, point.lat]);
            // console.log(newPath);
          }
        },
        editable: false
      },
      markers: []
    };
  },
  methods: {
    changeEditable() {
      this.polyline.editable = !this.polyline.editable;
    }
  }
};
</script>


<style lang="css">
#demoComponent {
  height: 800px;
}
</style>
