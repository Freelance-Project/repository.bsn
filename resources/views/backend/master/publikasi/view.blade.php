@extends('frontend.layouts.layout')

@section('content')
    <section id="middle" class="pageBlog">

        <div id="bannerPage">
            <div class="container">
                <div class="textCaption">
                    <div class="center">
                        <img src="{{ \Helper::assetUrl() }}frontend/images/content/momDiary.png"/>
                    </div>
                </div>
            </div>
            <div class="img" style="background:url('{{ \Helper::assetUrl() }}frontend/images/content/bannerBlog.jpg') no-repeat center top; background-size:cover;"></div>
        </div>

        <div id="contentPage">
            <div class="container clearfix">

                <div id="leftColumn">
                    <div id="navSub">
                        <div class="container">
                            <ul>
                                <li><a href="">Latest Post</a></li>
                                <li><a href="">Recommended post</a></li>
                                <li><a href="">most popular</a></li>
                            </ul>
                        </div>
                    </div>

                    <div id="article">
                        <div class="picture"><img src="{{ publicContent().$model->image }}"/></div>
                        <div class="inner">
                            <h3>
                                {{ $model->title }}
                            </h3>
                            <div class="entri_meta">
                                <ul>
                                    <li><div class="date">{{ date("F d , Y" , strtotime($model->date)) }}</div></li>
                                    <li><div class="title">{{ $model->user->name }}</div></li>
                                    <li><div class="like">7 Loves</div></li>
                                    <li><div class="viewed">30 Views</div></li>
                                </ul>
                            </div>
                            <div class="entri_descrip">
                                {!! $model->description  !!}
                            </div>
                            <div class="entri_tag">
                                <h5>CREDITS</h5>
                                <ul>
                                    @if(!empty($model->photography))
                                        <li><div class="cat">Photography: <span>{{ $model->photography }}</span></div></li>
                                    @endif

                                    @if(!empty($model->venue))
                                        <li><div class="cat">Venue: <span>{{ $model->venue }}</span></div></li>
                                    @endif

                                    @if(!empty($model->hair_makeup))
                                        <li><div class="cat">Hair &amp; Makeup: <span>{{ $model->hair_makeup }}</span></div></li>
                                    @endif

                                    @if(!empty($model->dress_attire))
                                        <li><div class="cat">Dress &amp; Attire: <span>{{ $model->dress_attire }}</span></div></li>
                                    @endif

                                    @if(!empty($model->decoration_lighting))
                                        <li><div class="cat">Decoration &amp; Lighting: <span>{{ $model->decoration_lighting }}</span></div></li>
                                    @endif

                                    @if(!empty($model->birthday_cake))
                                        <li><div class="cat">Birthday Cake: <span>{{ $model->birthday_cake }}</span></div></li>
                                    @endif

                                </ul>
                            </div>



                        </div>

                    </div>
                </div>


                <div id="rightColumn">
                    <div class="sideSearch">
                        <form method="post" action="">
                            <fieldset>
                                <input type="submit" value=""/>
                                <input type="text" value="Search diary post..." onfocus="if(value==='Search diary post...') value='';" onblur="if(value==='') value='Search diary post...';"/>
                            </fieldset>
                        </form>
                    </div>

                    <div class="block_recommended">
                        <h3>Recommended Posts</h3>
                        <ul>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/recommended_1.jpg"/></div>
                                <p class="txt">
                                    Tea Party for Mom and Daug...
                                </p>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/recommended_2.jpg"/></div>
                                <p class="txt">
                                    Parenting Guide 101
                                </p>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/recommended_3.jpg"/></div>
                                <p class="txt">
                                    We are Sisters for Life
                                </p>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/recommended_4.jpg"/></div>
                                <p class="txt">
                                    When Your Little Fingers Wr...
                                </p>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/recommended_5.jpg"/></div>
                                <p class="txt">
                                    Make Your Baby Falls Asleep...
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="latestPost">
                        <h3>Recommended Posts</h3>
                        <ul class="clearfix">
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_1.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_2.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_3.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_4.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_5.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_6.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_7.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_8.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_9.jpg"/></div>
                            </li>
                            <li>
                                <div class="img"><img src="{{ \Helper::assetUrl() }}frontend/images/content/latesPost_10.jpg"/></div>
                            </li>
                        </ul>
                        <div class="btnAll">
                            <a href="">view all posts</a>
                        </div>
                   </div>

                </div>

            </div>
        </div>
    </section><!-- end middle -->
@endsection
