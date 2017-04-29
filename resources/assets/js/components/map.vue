<template lang="html">
  <div id="amap-cointainer">
    <el-amap vid="amap" :zoom="zoom" :center="center">
			  <!-- <el-amap-marker v-for="marker in markers" :icon="marker.icon" :position="marker.position" :events="marker.events" :visible="marker.visible" :draggable="marker.draggable"></el-amap-marker> -->
		  </el-amap>
  </div>
</template>

<script>
export default {

};
</script>

<style lang="css">
#amap-cointainer {
  height: 800px;
}
</style>
