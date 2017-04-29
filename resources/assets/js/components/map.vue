<template lang="html">
  <div id="demoComponent" class="demo-component">
      <el-amap vid="amap" :zoom="zoom" :center="center" :amapManager="amapManager">
        <el-amap-polyline :editable="polyline.editable"  :path="polyline.path" :events="polyline.events"></el-amap-polyline>
        <div v-for="marker in markers">
        <el-amap-marker  :position="marker.position" :events="marker.events" :visible="marker.visible" :draggable="marker.draggable"></el-amap-marker>
        </div>
      </el-amap>
      <button type="button" name="button" v-on:click="changeEditable">change editable</button>
  </div>
</template>

<script>
import { AMapManager } from 'vue-amap';
let amapManager = new AMapManager();
const POLYGON_ID = 'POLYGON_ID';
export default {
  name: 'demoComponent',
  created() {
    axios.get('api/allvideo/1')
          .then(response => {
            let k=response.data;
            let i=0;
            while (k[i]!=null) {
              let marker={
                position: [k[i].lng, k[i].lat],
                events: {
                  click: () => {
                    alert('click marker2');
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
