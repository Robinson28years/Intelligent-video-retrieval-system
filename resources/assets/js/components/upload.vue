<template lang="html">
  <el-row>
    <el-row type="flex"  justify="center">
      <template>
        <el-select @change="select" v-model="value" placeholder="请选择案件">
          <el-option
          v-for="item in options"
          :key="item.value"
          :label="item.label"
          :value="item.value">
        </el-option>
      </el-select>
    </template>
    <el-button type="primary" icon="edit" @click="newcase">新建案件</el-button>
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
  <el-row type="flex"  justify="center">
    <el-table
  :data="tableData"
  style="width: 100%">
  <el-table-column
    prop="name"
    label="视频名称"
    width="180">
  </el-table-column>
  <el-table-column
    prop="lng"
    label="经度"
    width="180">
  </el-table-column>
  <el-table-column
    prop="lat"
    label="纬度">
  </el-table-column>
  <el-table-column
    prop="start"
    label="监控时间">
  </el-table-column>
  <el-table-column
    prop="label"
    label="所在目录">
  </el-table-column>
  <el-table-column
    prop="status"
    label="状态">
  </el-table-column>
</el-table>
  </el-row>
<el-dialog title="视频详情" v-model="dialogFormVisible">
<el-col :span="10" :offset="5">
  <el-form ref="form" :model="form" label-width="80px">

<el-form-item label="视频名称">
  <el-input v-model="form.name"></el-input>
</el-form-item>
<el-form-item label="经纬度">
  <el-col :span="11">
    <el-input v-model="form.lng" placeholder="经度"></el-input>
  </el-col>
  <el-col class="line" :span="2">-</el-col>
  <el-col :span="11">
    <el-input v-model="form.lat" placeholder="纬度"></el-input>
  </el-col>
</el-form-item>
<el-form-item label="监控时间">
    <el-date-picker
      v-model="form.date"
      type="datetime"
      placeholder="选择日期时间"
      align="right">
    </el-date-picker>
</el-form-item>
<el-form-item label="队列优先">
  <el-switch on-text="" off-text="" v-model="form.delivery"></el-switch>
</el-form-item>
<el-form-item>
  <el-button type="primary" @click="onSubmit">立即创建</el-button>
  <el-button @click="dialogFormVisible = false">取消</el-button>
</el-form-item>
</el-form>
</el-col>
</el-dialog>
<el-dialog title="新建案件" v-model="dialognewcase">
<el-col :span="10" :offset="5">
  <el-form ref="form2" :model="form2" label-width="80px">

<el-form-item label="案件名称">
  <el-input v-model="form2.name"></el-input>
</el-form-item>

<el-form-item label="是否重点">
  <el-switch on-text="" off-text="" v-model="form.delivery"></el-switch>
</el-form-item>
<el-form-item>
  <el-button type="primary" @click="onSubmit2">立即创建</el-button>
  <el-button  @click="dialognewcase = false">取消</el-button>
</el-form-item>
</el-form>
</el-col>
</el-dialog>
</el-row>
</template>
<script>
Date.prototype.Format = function (fmt) {
  var o = {
    "y+": this.getFullYear(),
    "M+": this.getMonth() + 1,                 //月份
    "d+": this.getDate(),                    //日
    "h+": this.getHours(),                   //小时
    "m+": this.getMinutes(),                 //分
    "s+": this.getSeconds(),                 //秒
    "q+": Math.floor((this.getMonth() + 3) / 3), //季度
    "S+": this.getMilliseconds()             //毫秒
  };
  for (var k in o) {
    if (new RegExp("(" + k + ")").test(fmt)){
      if(k == "y+"){
        fmt = fmt.replace(RegExp.$1, ("" + o[k]).substr(4 - RegExp.$1.length));
      }
      else if(k=="S+"){
        var lens = RegExp.$1.length;
        lens = lens==1?3:lens;
        fmt = fmt.replace(RegExp.$1, ("00" + o[k]).substr(("" + o[k]).length - 1,lens));
      }
      else{
        fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
      }
    }
  }
  return fmt;
}
  export default {
    created() {
      axios.get('api/allcase')
      .then(response => {
        let k = response.data;
        let i=0;
        while (k[i]!=null) {
          let option={
            value:k[i].id,
            label:k[i].name,
          };
          console.log(option);
          this.options.push(option);
          i++;
        }
        console.log(response.data);
      })
    },
    data() {
      return {
        value:null,
        options: [],
        form: {
          name: '',
          label:null,
          lng: '',
          lat: '',
          date:'',
          delivery:false,
        },
        form2: {
          name: '',
        },
        tableData: [],
        dialogFormVisible: false,
        dialognewcase: false,
        fileList: []
        // fileList: [{name: 'food.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}, {name: 'food2.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}]
      };
    },
    methods: {
      select(){
        console.log(this.value);
        axios.get('api/allvideo/'+this.value)
        .then(response => {
          // console.log(response.data);
          this.tableData=response.data;
        })
      },
      success(response, file, fileList) {
        this.form.name=file.name;
        this.form.label=response;
        // console.log(response);
        // console.log(file);
        this.dialogFormVisible=true;
      },
      submitUpload() {
        this.$refs.upload.submit();
      },
      onSubmit() {
        console.log(this.form.date);
        axios.post('api/addvideo',{
          name:this.form.name,
          lng:this.form.lng,
          lat:this.form.lat,
          start: (new Date(this.form.date)).Format("yyyy-MM-dd hh:mm:ss"),
          label:this.form.label,
          status:"未处理",
          lawcase_id:this.value,
        }).then(response => {
          this.tableData.push(response.data)
          console.log(response.data);
        })
      },
      onSubmit2() {
        axios.post('api/addcase',{
          name: this.form2.name
        }).then(response=>{
          let option={
            value:response.data.id,
            label:response.data.name,
          };
          this.options.push(option);
          this.value=response.data.id;
          this.dialognewcase=false;
          // console.log("ok");
          // console.log(response.data);

        })
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePreview(file) {
        console.log(file);
      },
      newcase(){
        this.dialognewcase=true;
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
