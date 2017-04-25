<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '智能视频检索系统') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body style="margin:0px;">
    <div id="app">
      <el-col :span="24">
        <el-menu theme="dark" class="el-menu-demo" mode="horizontal">
          <el-menu-item index="1">处理中心</el-menu-item>
        </el-menu>
      </el-col>
      <el-row>
        <el-col :span="3" >
          <el-menu style="height: 1000px;" router  class="el-menu-vertical-demo" theme="dark">
            <el-menu-item index="/1"><i class="el-icon-menu"></i>视频上传</el-menu-item>
            <el-menu-item index="/2"><i class="el-icon-setting"></i>任务查看</el-menu-item>
            <el-menu-item index="/3"><i class="el-icon-menu"></i>地图定位</el-menu-item>
          </el-menu>
        </el-col>
        <el-col :span="21">
          <router-view></router-view>
        </el-col>
      </el-row>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
