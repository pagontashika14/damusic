@extends('layouts.app',['activemenuitem'=>'home'])

@section('content-header')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Test
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">
        Test
      </li>
    </ol>
  </section>
@stop

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <!-- The time line -->
        <ul class="timeline" style="margin-bottom: 50px;">
          <!-- timeline time label -->
          <li class="time-label">
            <span class="bg-red">
              10 Feb. 2014
            </span>
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-envelope bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
              <h3 class="timeline-header"><a href="#">Dương Tuấn Đạt</a> shared a song</h3>
              <div class="timeline-body">
                <div>Một giọng ca sâu lắng và trìu mến...</div>
                <div id="player1" style="margin-top: 10px; margin-bottom: 10px;"></div>
                <div style="text-align: center;">
                  <div style="font-size: 20px; margin-right: 5px; margin-left: 5px;">Em Tôi</div>
                  <div style="color: #721799;">Anh Khang - Thùy Chi</div>
                </div>
              </div>
              <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">Read more</a>
                <a class="btn btn-danger btn-xs">Delete</a>
              </div>
            </div>
          </li>
          <!-- END timeline item -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-user bg-aqua"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
              <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
              <div class="timeline-body">
                <div id="player2" style="margin-top: 10px; margin-bottom: 10px;"></div>
              </div>
            </div>
          </li>
          <!-- END timeline item -->
          
          <li>
            <i class="fa fa-clock-o bg-gray"></i>
          </li>
        </ul>
      </div>
      <!-- /.col -->
      <div class="col-md-4 row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Có thể bạn muốn nghe</h3>
            </div>
            <div class="box-body">
              The body of the box
            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Bảng xếp hạng</h3>
            </div>
            <div class="box-body">
              The body of the box
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
@stop

@push('styles')
  <style type="text/css">
    .slider-selection {
      background: #9600FF;
    }
    @media screen and (max-width: 480px) {
      .div-volume { 
        display:none !important;
      }
    }
  </style>
@endpush

@push('scripts')
  <script>
    var audio_player = new AudioPlayer({
      skin : 'audio-single',
      div_player : $('#player1'),
      code : '222',
      srcs : [{
              code : 'em-toi',
              src : '{{env('APP_URL')}}'+'/songs/em-toi'
            },{
              code : 'will-think-of-you',
              src : '{{env('APP_URL')}}'+'/songs/will-think-of-you'
            }]
    });

    var audio_player2 = new AudioPlayer({
      skin : 'audio-single',
      div_player : $('#player2'),
      code : '223',
      srcs : [{
              code : 'will-think-of-you',
              src : '{{env('APP_URL')}}'+'/songs/will-think-of-you'
            }]
    });

    var audio_controler = new AudioControler([audio_player,audio_player2]);
  </script>
@endpush
