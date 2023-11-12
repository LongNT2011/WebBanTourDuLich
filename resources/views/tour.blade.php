@extends('layouts.master')

@section('content')

    <div class="hero-wrap js-fullheight" style="background-image: url({{ asset('images/bg_3.jpg') }});">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span>Tour</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Danh Sách Tour</h1>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
        	
          <div class="col-lg-12">
          	<div class="row">
			  @foreach($tours as $tour)
				@foreach($tour->tourDetail as $detail)
          		<div class="col-md-4 ftco-animate">
		    				<div class="destination">
		    					<a href="{{route('tour.detail', ['detail'=>$detail])}}" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ Storage::url($tour->image) }});">
		    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-search2"></span>
    						</div>
		    					</a>
		    					<div class="text p-3">
		    						<div class="d-flex">
		    							<div class="one">
				    						<h3><a href="{{route('tour.detail', ['detail'=>$detail])}}">{{$tour->tourName}}</a></h3>
				    						<!-- <p class="rate">
				    							<i class="icon-star"></i>
				    							<i class="icon-star"></i>
				    							<i class="icon-star"></i>
				    							<i class="icon-star"></i>
				    							<i class="icon-star-o"></i>
				    							<span>8 Rating</span>
				    						</p> -->
			    						</div>


		    						</div>

									<p><span style="color: red; font-size: 16px;" class="price">{{$detail->childrenPrice}} - {{$detail->adultPrice}} VNĐ</span></p>

<!-- 		    						
		    						<p>Far far away, behind the word mountains, far from the countries</p> -->
		    						<p class="days"><span>{{ date('d/m/Y', strtotime($detail->checkInDate)) }} - {{ date('d/m/Y', strtotime($detail->checkOutDate)) }}</span></p>
		    						<hr>
		    						<p class="bottom-area d-flex">
		    							<span><i class="icon-map-o"></i> {{$detail->depatureLocation}}</span> 
		    							<span class="ml-auto"><a href="{{route('tour.detail', ['detail'=>$detail])}}">Đặt Ngay</a></span>
		    						</p>
		    					</div>
		    				</div>
		    			</div>
						@endforeach
				@endforeach

          	</div>
          	<div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
					  @if ($tours->onFirstPage())
					  <li><a href="#">&lt;</a></li>
                @else
                  <li class="page-item">
				  <li><a href="{{ $tours->previousPageUrl() }}" aria-label="Previous"> &lt;</a></li>
                  </li>
                @endif

                @foreach ($tours->getUrlRange(1, $tours->lastPage()) as $page => $url)
                  <li class="active"  {{ $page == $tours->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}">{{ $page }}</a>
                  </li>
                @endforeach

                @if ($tours->hasMorePages())
				<li><a href="{{ $tours->nextPageUrl() }}" aria-label="Next">&gt;</a></li>

                @else
				<li><a href="#">&gt;</a></li>
                @endif
		              </ul>
		            </div>
		          </div>
		        </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
@stop
