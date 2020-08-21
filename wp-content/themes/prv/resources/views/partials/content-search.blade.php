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
"post_thumbnail" =>wp_get_attachment_image(get_post_thumbnail_id($value->ID), 'medium',"", "", array("class"
=> "img-fluid")),
"post_permalink"=>get_permalink($value->ID)
) ;
array_push( $result_posts,$data);
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

<section class="container container__page-content pt-5">
  <div class="row">
    <div class="col-12 text-center">
      @if(!empty($search_result["result_products"]) )
      <h2 class="search-form__title">Ürünler</h2>
      <div class="container-fluid  pr-5 pl-5 pt-2 mb-5">
        <div class="search-slider search-slider__product ">
          @foreach ($search_result["result_products"] as $result)
          <div class="search-slider__inner text-center">
            <a class="" href="{!! $result['post_permalink'] !!}">
              {!! $result["post_thumbnail"] !!}
              <h5>{!! $result["post_title"] !!}</h5>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      @if(!empty($search_result["result_pages"]) )
      <h2 class="search-form__title">Sayfalar</h2>
      <div class="container-fluid  pr-5 pl-5 pt-2 mb-5">
        <div class="search-slider search-slider__page">
          @foreach ($search_result["result_pages"] as $result)
          <div class="search-slider__inner text-center">
            <a class="" href="{!! $result['post_permalink'] !!}">
              {!! $result["post_thumbnail"] !!}
              <h5>{!! $result["post_title"] !!}</h5>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      @if(!empty($search_result["result_posts"]) )
      <h2 class="search-form__title">Bog Yazıları</h2>
      <div class="container-fluid  pr-5 pl-5 pt-2 mb-5">
        <div class="search-slider search-slider__post">
          @foreach ($search_result["result_posts"] as $result)
          <div class="search-slider__inner text-center ">
            <a class="" href="{!! $result['post_permalink'] !!}">
              {!! $result["post_thumbnail"] !!}
              <h5>{!! $result["post_title"] !!}</h5>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      @endif

    </div>
  </div>
</section>
