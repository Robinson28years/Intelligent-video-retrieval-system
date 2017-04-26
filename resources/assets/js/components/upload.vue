<template lang="html">
  <el-row>
    <el-row type="flex"  justify="center">
      <template>
        <el-select v-model="value" placeholder="请选择案件">
          <el-option
          v-for="item in options"
          :label="item.label"
          :value="item.value">
        </el-option>
      </el-select>
    </template>
    <el-button type="primary" icon="edit">新建案件</el-button>
  </el-row>
  <el-row type="flex"  justify="center">
    <!-- <el-upload
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
      <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
    </el-upload> -->
    <el-upload
      class="upload-demo"
      drag
      :on-success="success"
      :file-list="fileList"
      action="/api/upload"
      multiple>
      <i class="el-icon-upload"></i>
      <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
      <div class="el-upload__tip" slot="tip">只能上传视频文件，且不超过2G</div>
    </el-upload>
  </el-row>
<el-dialog title="视频详情" v-model="dialogFormVisible">
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
    created() {
      axios.get('api/allcase')
      .then(response => {
        console.log(response.data);
      })
    },
    data() {
      return {
        value:'',
        options: [{
          value: '选项1',
          label: '黄金糕'
        }, {
          value: '选项2',
          label: '双皮奶'
        }, {
          value: '选项3',
          label: '蚵仔煎'
        }, {
          value: '选项4',
          label: '龙须面'
        }, {
          value: '选项5',
          label: '北京烤鸭'
        }],
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
<style lang="css" scoped>
.el-row {
  margin-top: 20px;
  margin-bottom: 20px;
  &:last-child {
    margin-bottom: 0;
  }
}
</style>
