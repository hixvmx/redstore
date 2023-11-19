@extends('layout.dashboard')
@section('metatags')
    <title>Categories - RedStore</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/categories.css') }}" />
@endsection

@section('content')
    <div class="db__sec wd__80">
        <div class="db__header">
            <h2>التصنيفات ({{count($categories)}})</h2>
        </div>
        <div class="db__body">
            <table id="categories">
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr id="{{ $category->isParent == true ? 'parent' : 'child'}}">
                                <td>
                                    <div class="category__data" onclick="alert('ok...');">
                                        <div class="category__image">
                                            <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" />
                                        </div>
                                        <div class="category__name" onclick="alert('ok...');">
                                            <p>{{ $category['name'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button>Delete</button>
                                    <button>Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>Not Found!</td>
                        </tr>
                    @endif
            </table>
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
                                        @if ($category->isParent == true)
                                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                                        @endif
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
    </script>
@endsection
