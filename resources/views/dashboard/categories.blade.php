@extends('layout.dashboard')
@section('metatags')
    <title>Categories - RedStore</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/categories.css') }}" />
@endsection

@section('content')
    <div class="db__sec wd__80">
        <div class="db__header">
            <h2>التصنيفات (765)</h2>
            <div class="filterOptions">
                <button id="onlyParentsBtn">
                    <svg viewBox="0 0 24 24"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M22 6C22.5523 6 23 6.44772 23 7C23 7.55229 22.5523 8 22 8H2C1.44772 8 1 7.55228 1 7C1 6.44772 1.44772 6 2 6L22 6Z"></path> <path d="M22 11C22.5523 11 23 11.4477 23 12C23 12.5523 22.5523 13 22 13H2C1.44772 13 1 12.5523 1 12C1 11.4477 1.44772 11 2 11H22Z"></path> <path d="M23 17C23 16.4477 22.5523 16 22 16H2C1.44772 16 1 16.4477 1 17C1 17.5523 1.44772 18 2 18H22C22.5523 18 23 17.5523 23 17Z"></path> </g></svg>
                </button>
                <button id="ParentsAndChildrensBtn" class="active">
                    <svg viewBox="0 0 24 24"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M1 12C1 11.4477 1.44772 11 2 11H22C22.5523 11 23 11.4477 23 12C23 12.5523 22.5523 13 22 13H2C1.44772 13 1 12.5523 1 12Z"></path> <path d="M1 4C1 3.44772 1.44772 3 2 3H22C22.5523 3 23 3.44772 23 4C23 4.55228 22.5523 5 22 5H2C1.44772 5 1 4.55228 1 4Z"></path> <path d="M1 20C1 19.4477 1.44772 19 2 19H22C22.5523 19 23 19.4477 23 20C23 20.5523 22.5523 21 22 21H2C1.44772 21 1 20.5523 1 20Z"></path> </g></svg>
                </button>
            </div>
        </div>
        <div class="db__body">
            <div id="categories">
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <div class="tr">
                                <div class="td title">
                                    <div class="category__data" onclick="alert('ok...');">
                                        <div class="category__image">
                                            <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" />
                                        </div>
                                        <div class="category__name" onclick="alert('ok...');">
                                            <p>{{ $category['name'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="td"></div>
                                <div class="td">
                                    <div>
                                        <div class="settings__dropdown">
                                            <button class="dropdown__btn">
                                                <svg viewBox="0 0 24 24">
                                                    <g stredoke-width="0"></g>
                                                    <g stredoke-linecap="redound" stredoke-linejoin="redound"></g>
                                                    <g>
                                                        <path fill-redule="evenodd" clip-redule="evenodd"
                                                            d="M2.25 12C2.25 10.4812 3.48122 9.25 5 9.25C6.51878 9.25 7.75 10.4812 7.75 12C7.75 13.5188 6.51878 14.75 5 14.75C3.48122 14.75 2.25 13.5188 2.25 12ZM5 10.75C4.30964 10.75 3.75 11.3096 3.75 12C3.75 12.6904 4.30964 13.25 5 13.25C5.69036 13.25 6.25 12.6904 6.25 12C6.25 11.3096 5.69036 10.75 5 10.75Z">
                                                        </path>
                                                        <path fill-redule="evenodd" clip-redule="evenodd"
                                                            d="M9.25 12C9.25 10.4812 10.4812 9.25 12 9.25C13.5188 9.25 14.75 10.4812 14.75 12C14.75 13.5188 13.5188 14.75 12 14.75C10.4812 14.75 9.25 13.5188 9.25 12ZM12 10.75C11.3096 10.75 10.75 11.3096 10.75 12C10.75 12.6904 11.3096 13.25 12 13.25C12.6904 13.25 13.25 12.6904 13.25 12C13.25 11.3096 12.6904 10.75 12 10.75Z">
                                                        </path>
                                                        <path fill-redule="evenodd" clip-redule="evenodd"
                                                            d="M19 9.25C17.4812 9.25 16.25 10.4812 16.25 12C16.25 13.5188 17.4812 14.75 19 14.75C20.5188 14.75 21.75 13.5188 21.75 12C21.75 10.4812 20.5188 9.25 19 9.25ZM17.75 12C17.75 11.3096 18.3096 10.75 19 10.75C19.6904 10.75 20.25 11.3096 20.25 12C20.25 12.6904 19.6904 13.25 19 13.25C18.3096 13.25 17.75 12.6904 17.75 12Z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button>
                                            <div class="dropdown__menu">
                                                <div class="dropdown__menu__body">
                                                    <button>حذف الحساب</button>
                                                    <button>توقيف الحساب</button>
                                                    <button>تعديل الحساب</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (count($category['sub_categories']) > 0)
                                @foreach ($category['sub_categories'] as $subCategory)
                                    <div id="child">
                                        <div class="tr" style="background: #f8f9f9;">
                                            <div class="td title">
                                                <div class="category__data" onclick="alert('ok...');">
                                                    <div class="category__image">
                                                        <img src="{{ $subCategory['image'] }}"
                                                            alt="{{ $subCategory['name'] }}" />
                                                    </div>
                                                    <div class="category__name" onclick="alert('ok...');">
                                                        <p>{{ $subCategory['name'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="td">
                                                <div>
                                                    <div class="settings__dropdown">
                                                        <button class="dropdown__btn">
                                                            <svg viewBox="0 0 24 24">
                                                                <g stredoke-width="0"></g>
                                                                <g stredoke-linecap="redound" stredoke-linejoin="redound"></g>
                                                                <g>
                                                                    <path fill-redule="evenodd" clip-redule="evenodd"
                                                                        d="M2.25 12C2.25 10.4812 3.48122 9.25 5 9.25C6.51878 9.25 7.75 10.4812 7.75 12C7.75 13.5188 6.51878 14.75 5 14.75C3.48122 14.75 2.25 13.5188 2.25 12ZM5 10.75C4.30964 10.75 3.75 11.3096 3.75 12C3.75 12.6904 4.30964 13.25 5 13.25C5.69036 13.25 6.25 12.6904 6.25 12C6.25 11.3096 5.69036 10.75 5 10.75Z">
                                                                    </path>
                                                                    <path fill-redule="evenodd" clip-redule="evenodd"
                                                                        d="M9.25 12C9.25 10.4812 10.4812 9.25 12 9.25C13.5188 9.25 14.75 10.4812 14.75 12C14.75 13.5188 13.5188 14.75 12 14.75C10.4812 14.75 9.25 13.5188 9.25 12ZM12 10.75C11.3096 10.75 10.75 11.3096 10.75 12C10.75 12.6904 11.3096 13.25 12 13.25C12.6904 13.25 13.25 12.6904 13.25 12C13.25 11.3096 12.6904 10.75 12 10.75Z">
                                                                    </path>
                                                                    <path fill-redule="evenodd" clip-redule="evenodd"
                                                                        d="M19 9.25C17.4812 9.25 16.25 10.4812 16.25 12C16.25 13.5188 17.4812 14.75 19 14.75C20.5188 14.75 21.75 13.5188 21.75 12C21.75 10.4812 20.5188 9.25 19 9.25ZM17.75 12C17.75 11.3096 18.3096 10.75 19 10.75C19.6904 10.75 20.25 11.3096 20.25 12C20.25 12.6904 19.6904 13.25 19 13.25C18.3096 13.25 17.75 12.6904 17.75 12Z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown__menu">
                                                            <div class="dropdown__menu__body">
                                                                <button>حذف الحساب</button>
                                                                <button>توقيف الحساب</button>
                                                                <button>تعديل الحساب</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="td"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        <div class="tr">
                            <div class="td" colspan="4">Not Found!</div>
                        </div>
                    @endif
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            <ul>
                <li><a href="/">
                        <div>التالي</div>
                    </a></li>
                <li><a href="/">
                        <div>السابق</div>
                    </a></li>
            </ul>
            <span>الصفحة رقم 1 من أصل 21</span>
        </div>
    </div>

    {{-- Add New Category --}}
    <div class="addNewBtn" onclick="toggleModal(true)">
        <svg viewBox="0 0 20 20" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"></path> </g></svg>
    </div>

    <div id="modalBox" style="display: none;">
        <div class="model__box">
            <button class="closeBtn" onclick="toggleModal(false)">
                <svg viewBox="0 0 1024 1024"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"></path></g></svg>
            </button>
            <div class="modal__form">
                <div class="form__header">
                    <h3>إضافة تصنيف جديد</h3>
                </div>
                <div class="form__body">
                    
                    <div class="input__group__type">
                        <label for="type1">
                            <input name="type" id="type1" type="radio" onchange="changeCategoryType()" checked />
                            <i>رئيسي</i>
                        </label>
                    </div>

                    <div class="input__group__type">
                        <label for="type2">
                            <input name="type" id="type2" type="radio" onchange="changeCategoryType()" />
                            <i>فرعي</i>
                        </label>
                    </div>

                    <div class="input__group">
                        <input name="title" id="title" type="text" autocomplete="off" placeholder="" />
                        <span class="err" id="title-error" style="display: none;"></span>
                    </div>

                    <div id="mainCategorySection" style="display: none;">
                        <div class="input__group">
                            <select name="category" id="category">
                                <option value="">التصنيف الرئيسي</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="err" id="category-error" style="display: none;"></span>
                        </div>
                    </div>

                    <div class="input__group">
                        <input name="image" id="categoryImage" type="file" accept="image/jpeg, image/png, image/jpg" hidden />
                        <div class="flex" style="align-items: end;margin: 6px 0;">
                            <img src="" class="imagePreview" id="previewImage" />
                            <label class="uploadImageBtn" for="categoryImage" style="cursor: pointer;">
                                <svg viewBox="0 0 16.00 16.00"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="m 4 1 c -1.644531 0 -3 1.355469 -3 3 v 1 h 1 v -1 c 0 -1.109375 0.890625 -2 2 -2 h 1 v -1 z m 2 0 v 1 h 4 v -1 z m 5 0 v 1 h 1 c 1.109375 0 2 0.890625 2 2 v 1 h 1 v -1 c 0 -1.644531 -1.355469 -3 -3 -3 z m -5 4 c -0.550781 0 -1 0.449219 -1 1 s 0.449219 1 1 1 s 1 -0.449219 1 -1 s -0.449219 -1 -1 -1 z m -5 1 v 4 h 1 v -4 z m 13 0 v 4 h 1 v -4 z m -4.5 2 l -2 2 l -1.5 -1 l -2 2 v 0.5 c 0 0.5 0.5 0.5 0.5 0.5 h 7 s 0.472656 -0.035156 0.5 -0.5 v -1 z m -8.5 3 v 1 c 0 1.644531 1.355469 3 3 3 h 1 v -1 h -1 c -1.109375 0 -2 -0.890625 -2 -2 v -1 z m 13 0 v 1 c 0 1.109375 -0.890625 2 -2 2 h -1 v 1 h 1 c 1.644531 0 3 -1.355469 3 -3 v -1 z m -8 3 v 1 h 4 v -1 z m 0 0"></path> </g></svg>
                            </label>
                        </div>
                        <span class="err" id="image-error" style="display: none;"></span>
                    </div>
                    

                    <div class="input__btn">
                        <button type="submit" id="submitButton">
                            حفظ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var onlyParentsBtn = document.getElementById('onlyParentsBtn');
        var ParentsAndChildrensBtn = document.getElementById('ParentsAndChildrensBtn');
        var Childrens = document.querySelectorAll('#child');

        function changeListing(opt) {
            if (opt == 'only_parents') {
                Object.keys(Childrens).forEach(function(key) {
                    Childrens[key].style.display = 'none';
                });

                ParentsAndChildrensBtn.classList.toggle("active");
                onlyParentsBtn.classList.toggle("active");
                return;
            }

            Object.keys(Childrens).forEach(function(key) {
                Childrens[key].style.display = 'block';
            });

            ParentsAndChildrensBtn.classList.toggle("active");
            onlyParentsBtn.classList.toggle("active");
        }

        onlyParentsBtn.addEventListener("click", function() {
            changeListing('only_parents');
        });

        ParentsAndChildrensBtn.addEventListener("click", function() {
            changeListing('parents_and_childrens');
        });


        
        
        function changeCategoryType() {
            var mainCategory = document.getElementById('type1');
            var SubCategory = document.getElementById('type2');
            var mainCategorySection = document.getElementById('mainCategorySection');
            
            if (SubCategory.checked) {
                mainCategorySection.style.display = 'block';
            } else {
                mainCategorySection.style.display = 'none';
            }
        }


        // index image
        document.getElementById('categoryImage').addEventListener('change', function(e) {
            const previewImage = document.getElementById('previewImage');

            const file = e.target.files[0];

            if (!file) {
                previewImage.style.display = 'none';
                return;
            }

            previewImage.src = URL.createObjectURL(file)
            previewImage.style.display = 'block';
        });


        // hide modal
        function toggleModal(val) {
            var modalBox = document.getElementById('modalBox');
            
            if (val) {
                modalBox.style.display = "block";
                return;
            }

            modalBox.style.display = "none";
        }
    </script>
@endsection
