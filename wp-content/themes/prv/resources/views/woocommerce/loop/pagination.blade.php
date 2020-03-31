{{--
/**
* Pagination - Show numbered pagination for catalog pages
*
* This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce/Templates
* @version 3.3.1
*/
--}}


@if ( ! defined( 'ABSPATH' ) ) exit; @endif


@php

$total = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart',
get_pagenum_link( 999999999, false ) ) ) );
$format = isset( $format ) ? $format : '';

@endphp


@if ( $total <= 1 ) return; @endif <nav aria-label="Page navigation">
  @php
  $paginate_links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
  'base' => $base,
  'format' => $format,
  'add_args' => false,
  'current' => max( 1, $current ),
  'total' => $total,
  'prev_text' => '&larr;',
  'next_text' => '&rarr;',
  'type' => 'array',
  'end_size' => 3,
  'mid_size' => 3,
  ) ) );
  @endphp
  @if ( is_array($paginate_links) )
  <ul class="pagination">
    @foreach ($paginate_links as $paginate_link)
    <li class="page-item">
      <div class="page-link">@php echo wp_kses_post($paginate_link) @endphp</div>
    </li>
    @endforeach
  </ul>
  @endif
  </nav>
