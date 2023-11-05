<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Ad;
    use App\Models\Category;
    use App\Models\SubCategory;

    $authCheck = Auth::check();
    $authUser = Auth::user();
    if ($authUser) {
        $adsCount = Ad::where('publisher', $authUser->id)->count();
    }

    // get categories
    $categories = Category::select('id','slug','name','image')->get();

    function getSubCategories($categoryID) {
        if (!empty($categoryID)) {

            $SubCategoriesData = SubCategory::select('id','slug','name','image')
            ->where('category', $categoryID)
            ->get();

            return $SubCategoriesData;
        }
        return [];
    }

?>
<header>
    <div class="header wd__80 flex aic__jcs ">
        <ul class="header__ul flex">
            @if ($authCheck)
                <li class="header__li">
                    <div class="header__user__dropdown">
                        <div class="img__icon">
                            <img src="{{ url($authUser->avatar ?? '') }}" alt="{{ $authUser->username }}" />
                        </div>
                        <div class="user__dropdown">
                            <div class="dropdown_body">
                                <div class="dropdown__user__card">
                                    <a href={{'/user' .'/'. $authUser->username}}>
                                        <div class="dropdown__user__card__body">
                                            <div>
                                                <div class="user__card__img">
                                                    <img src="{{$authUser->avatar}}" alt="{{ $authUser->username }}" />
                                                </div>
                                            </div>
                                            <div class="user__card__name">
                                                <span>{{ $authUser->firstname .' '. $authUser->lastname }}</span>
                                                <i>{{$adsCount ?? ''}} إعلان</i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @if ($authUser->isAdmin == 1)
                                <a class="a" href='/dashboard'>
                                    <div>
                                        <span>لوحة التحكم</span>
                                    </div>
                                </a>
                                @endif
                                <a class="a" href={{'/user' .'/'. $authUser->username}}>
                                    <div>
                                        <span>حسابي</span>
                                    </div>
                                </a>
                                <a class="a" href="/account/ads">
                                    <div>
                                        <span>إعلاناتي</span>
                                    </div>
                                </a>
                                <a class="a" href="/account/favorites">
                                    <div>
                                        <span>المفضلة</span>
                                    </div>
                                </a>
                                <a class="a" href="/account/settings">
                                    <div>
                                        <span>إعدادات الحساب</span>
                                    </div>
                                </a>
                                <a class="a" href="/logout">
                                    <div>
                                        <span>تسجيل الخروح</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
            <li class="header__li">
                <div class="header__publish__btn">
                    <a href="/new-ad">
                        <div>
                            <span>انشر إعلانك</span>
                        </div>
                    </a>
                </div>
            </li>
            @if (!$authCheck)
            <li class="header__li">
                <div class="header__login__btn">
                    <a href="/login">
                        <div>
                            <i class="icon-login"></i>
                            <span>دخول</span>
                        </div>
                    </a>
                </div>
            </li>
            @endif
        </ul>
        <div class="header__logo">
            <a href="/">
                <img src="/image/logo.png" alt="" />
            </a>
        </div>
    </div>
    <nav>
        <div class="nav wd__80 flex aic__jcs ">
            <ul class="nav__ul">

                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <li class="nav__li">
                            <div class="category__li">
                                <a href="/search?category={{$category->id}}">
                                    <div class="category__title">
                                        <span>{{$category->name}}</span>
                                    </div>
                                </a>
                                <div class="sub__category">
                                    <div class="sub__category__row">
                                        <?php $SubCategories = getSubCategories($category->id); ?>
                                        @if (count($SubCategories) > 0)
                                            @foreach ($SubCategories as $subCategory)
                                                <div class="sub__category__link">
                                                    <a href="/search?category={{$category->id}}&subCategory={{$subCategory->id}}">
                                                        <div>
                                                            <img src="{{$subCategory->image}}" alt="{{$subCategory->name}}" />
                                                            <span>{{$subCategory->name}}</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </nav>
</header>
