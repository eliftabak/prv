<section class="container container__page-content pt-5">
  <div class="row">
    <div class="col-12">
      @php
      global $wp_query;
      $total_results = $wp_query->found_posts;
      $result_posts=[];
      $result_pages=[];
      $result_products=[];


      foreach ($wp_query->posts as $value) {

      if($value -> post_status == "publish"){

      switch ($value->post_type) {
      case 'product':

      $data =array(
      "ID" => $value->ID,
      "post_title"=>$value->post_title,
      "post_content"=>wp_trim_words( $value->post_content, 40, '...' ),
      "post_thumbnail" => wp_get_attachment_image(get_post_thumbnail_id($value->ID), 'medium',"", "", array("class"
      => "img-fluid")),
      "post_permalink"=>get_permalink($value->ID)
      ) ;
      array_push( $result_products,$data);
      break;

      case 'page':

      $data =array(
      "ID" => $value->ID,
      "post_title"=>$value->post_title,
      "post_content"=>wp_trim_words( $value->post_content, 40, '...' ),
      "post_thumbnail" => wp_get_attachment_image(get_post_thumbnail_id($value->ID), 'thumbnail',"", "", array("class"
      => "img-fluid")),
      "post_permalink"=>get_permalink($value->ID)
      ) ;
      array_push( $result_pages,$data);
      break;

      case 'post':
      $data =array(
      "ID" => $value->ID,
      "post_title"=>$value->post_title,
      "post_content"=>wp_trim_words( $value->post_content, 40, '...' ),
      "post_thumbnail" =>wp_get_attachment_image(get_post_thumbnail_id($value->ID), 'thumbnail',"", "", array("class"
      => "img-fluid")),
      "post_permalink"=>get_permalink($value->ID)
      ) ;
      array_push( $result_page,$data);
      break;

      default:
      break;
      }
      }
      }

      $search_result = array(
      "result_products"=>$result_products,
      "result_posts"=>$result_posts,
      "result_pages"=>$result_pages
      );
      @endphp

      //TODO: Continue from here

      <h2>Ürünler</h2>
      <div class="container-fluid shadow-sm p-4">
        <div id="myCarousel" class="carousel slide w-100 multiple-carousel" data-ride="carousel" data-interval="false">
          <div class="carousel-inner w-100" role="listbox">
            @php
            $index = 0;
            @endphp
            @foreach ($search_result["result_products"] as $result)
            @php
            $active = $index === 0 ? "active":"";
            @endphp
            <div class="carousel-item {{ $active }}">
              <a class="col-lg-3 col-md-6" href="{!! $result['post_permalink'] !!}">
                {!! $result["post_thumbnail"] !!}
                <h5>{!! $result["post_title"] !!}</h5>
              </a>
            </div>
            @php
            $index =+ 1;
            @endphp
            @endforeach
          </div>
          <a class="carousel-control-prev w-auto text-primary" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
              <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next  w-auto text-primary" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa fa-long-arrow-right"
                aria-hidden="true"></i>
            </span>

            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

      <h2>Sayfalar</h2>
      <div class="container-fluid shadow-sm p-4">
        <div id="myCarousel" class="carousel slide w-100 multiple-carousel" data-ride="carousel" data-interval="false">
          <div class="carousel-inner w-100" role="listbox">
            @php
            $index = 0;
            @endphp
            @foreach ($search_result["result_pages"] as $result)
            @php
            $active = $index === 0 ? "active":"";
            @endphp
            <div class="carousel-item {{ $active }}">
              <div class="col-lg-3 col-md-6">
                {!! $result["post_thumbnail"] !!}
                <h5>{!! $result["post_title"] !!}</h5>
              </div>
            </div>
            @php
            $index =+ 1;
            @endphp
            @endforeach
          </div>
          <a class="carousel-control-prev  w-auto text-primary" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next  w-auto text-primary" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>


      <h2>Bog Yazıları</h2>
      <div class="container-fluid shadow-sm p-4">
        <div id="myCarousel" class="carousel slide w-100 multiple-carousel" data-ride="carousel" data-interval="false">
          <div class="carousel-inner w-100" role="listbox">
            @php
            $index = 0;
            @endphp
            @foreach ($search_result["result_posts"] as $result)
            @php
            $active = $index === 0 ? "active":"";
            @endphp
            <div class="carousel-item {{ $active }}">
              <div class="col-lg-3 col-md-6">
                {!! $result["post_thumbnail"] !!}
                <h5>{!! $result["post_title"] !!}</h5>
              </div>
            </div>
            @php
            $index =+ 1;
            @endphp
            @endforeach
          </div>
          <a class="carousel-control-prev  w-auto text-primary" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next  w-auto text-primary" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
