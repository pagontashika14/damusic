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
      <div class="col-md-9">
        <!-- The time line -->
        <ul class="timeline">
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
                <audio style="width: 100%;" controls>
                  <source src="http://mp3.zing.vn/download/song/Em-Toi-Anh-Khang-Thuy-Chi/ZmxnTkmadRDNBkkTLFJyDmkH" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
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
            </div>
          </li>
          <!-- END timeline item -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-comments bg-yellow"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

              <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

              <div class="timeline-body">
                Take me to your leader!
                Switzerland is small and neutral!
                We are more like Germany, ambitious and misunderstood!
              </div>
              <div class="timeline-footer">
                <a class="btn btn-warning btn-flat btn-xs">View comment</a>
              </div>
            </div>
          </li>
          <!-- END timeline item -->
          <!-- timeline time label -->
          <li class="time-label">
            <span class="bg-green">
              3 Jan. 2014
            </span>
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-camera bg-purple"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

              <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

              <div class="timeline-body">
                <img src="http://placehold.it/150x100" alt="..." class="margin">
                <img src="http://placehold.it/150x100" alt="..." class="margin">
                <img src="http://placehold.it/150x100" alt="..." class="margin">
                <img src="http://placehold.it/150x100" alt="..." class="margin">
              </div>
            </div>
          </li>
          <!-- END timeline item -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-video-camera bg-maroon"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>

              <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

              <div class="timeline-body">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen=""></iframe>
                </div>
              </div>
              <div class="timeline-footer">
                <a href="#" class="btn btn-xs bg-maroon">See comments</a>
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
      <div class="col-md-3">
        <div class="box box-success box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Có thể bạn muốn nghe</h3>
          </div>
          <div class="box-body">
            The body of the box
          </div>
        </div>
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
  </section>
@stop

@push('scripts')
  <script>

  </script>
@endpush
