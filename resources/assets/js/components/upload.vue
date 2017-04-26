<template lang="html">
  <el-row>
    <el-upload
      class="upload-demo"
      ref="upload"
      action="/api/upload"
      :on-preview="handlePreview"
      :on-remove="handleRemove"
      :file-list="fileList"
      :on-success="success"
      :auto-upload="false">
      <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
      <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传到服务器</el-button>
      <!-- <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div> -->
    </el-upload>
<el-dialog title="收货地址" v-model="dialogFormVisible">
<el-col :span="10" :offset="5">
  <el-form ref="form" :model="form" label-width="80px">

<el-form-item label="视频名称">
  <el-input v-model="form.name"></el-input>
</el-form-item>
<el-form-item label="经纬度">
  <el-select v-model="form.region" placeholder="请选择活动区域">
    <el-option label="区域一" value="shanghai"></el-option>
    <el-option label="区域二" value="beijing"></el-option>
  </el-select>
</el-form-item>
<el-form-item label="监控时间">
  <el-col :span="11">
    <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
  </el-col>
  <el-col class="line" :span="2">-</el-col>
  <el-col :span="11">
    <el-time-picker type="fixed-time" placeholder="选择时间" v-model="form.date2" style="width: 100%;"></el-time-picker>
  </el-col>
</el-form-item>
<el-form-item label="队列优先">
  <el-switch on-text="" off-text="" v-model="form.delivery"></el-switch>
</el-form-item>
<el-form-item>
  <el-button type="primary" @click="onSubmit">立即创建</el-button>
  <el-button>取消</el-button>
</el-form-item>
</el-form>
</el-col>
</el-dialog>

</el-row>
</template>
<script>
  export default {
    data() {
      return {
        form: {
          name: '',
          region: '',
          date1: '',
          date2: '',
          delivery: false,
          type: [],
          resource: '',
          desc: ''
        },
        dialogFormVisible: false,
        // fileList: []
        fileList: [{name: 'food.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}, {name: 'food2.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}]
      };
    },
    methods: {
      success(response, file, fileList) {
        console.log(response);
        console.log(file);
        this.dialogFormVisible=true;
      },
      submitUpload() {
        this.$refs.upload.submit();
      },
      onSubmit() {
        console.log(this.fileList);
        console.log('submit!');
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePreview(file) {
        console.log(file);
      }
    }
  }
</script>
