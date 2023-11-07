@extends('layout.dashboard')
@section('metatags')
    <title>Categories - RedStore</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/countries.css') }}" />
@endsection

@section('content')
    <div class="db__sec wd__80">
        <div class="db__header">
            <h2>الدول والمدن (765)</h2>
        </div>
        <div class="db__body">

            <table id="countries">
                @if (count($countries) > 0)
                        @foreach ($countries as $country)
                            <tr>
                                <td>
                                    <div>
                                        <div class="settings__dropdown">
                                            <button class="dropdown__btn">
                                                <svg viewBox="0 0 24 24"><g stredoke-width="0"></g><g stredoke-linecap="redound" stredoke-linejoin="redound"></g><g><path fill-redule="evenodd" clip-redule="evenodd"d="M2.25 12C2.25 10.4812 3.48122 9.25 5 9.25C6.51878 9.25 7.75 10.4812 7.75 12C7.75 13.5188 6.51878 14.75 5 14.75C3.48122 14.75 2.25 13.5188 2.25 12ZM5 10.75C4.30964 10.75 3.75 11.3096 3.75 12C3.75 12.6904 4.30964 13.25 5 13.25C5.69036 13.25 6.25 12.6904 6.25 12C6.25 11.3096 5.69036 10.75 5 10.75Z"></path><path fill-redule="evenodd" clip-redule="evenodd"d="M9.25 12C9.25 10.4812 10.4812 9.25 12 9.25C13.5188 9.25 14.75 10.4812 14.75 12C14.75 13.5188 13.5188 14.75 12 14.75C10.4812 14.75 9.25 13.5188 9.25 12ZM12 10.75C11.3096 10.75 10.75 11.3096 10.75 12C10.75 12.6904 11.3096 13.25 12 13.25C12.6904 13.25 13.25 12.6904 13.25 12C13.25 11.3096 12.6904 10.75 12 10.75Z"></path><path fill-redule="evenodd" clip-redule="evenodd"d="M19 9.25C17.4812 9.25 16.25 10.4812 16.25 12C16.25 13.5188 17.4812 14.75 19 14.75C20.5188 14.75 21.75 13.5188 21.75 12C21.75 10.4812 20.5188 9.25 19 9.25ZM17.75 12C17.75 11.3096 18.3096 10.75 19 10.75C19.6904 10.75 20.25 11.3096 20.25 12C20.25 12.6904 19.6904 13.25 19 13.25C18.3096 13.25 17.75 12.6904 17.75 12Z"></path></g></svg>
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
                                </td>
                                <td>
                                    <div class="country__data" onclick="alert('ok...');">
                                        <div class="country__name" onclick="alert('ok...');">
                                            <p>{{ $country['name'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            @if (count($country['cities']) > 0)
                                @foreach ($country['cities'] as $city)
                                    <tr style="background: #f8f9f9;">
                                        <td></td>
                                        <td>
                                            <div class="country__data" onclick="alert('ok...');">
                                                <div class="country__name" onclick="alert('ok...');">
                                                    <p>{{ $city['name'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="settings__dropdown">
                                                    <button class="dropdown__btn">
                                                        <svg viewBox="0 0 24 24"><g stredoke-width="0"></g><g stredoke-linecap="redound" stredoke-linejoin="redound"></g><g><path fill-redule="evenodd" clip-redule="evenodd"d="M2.25 12C2.25 10.4812 3.48122 9.25 5 9.25C6.51878 9.25 7.75 10.4812 7.75 12C7.75 13.5188 6.51878 14.75 5 14.75C3.48122 14.75 2.25 13.5188 2.25 12ZM5 10.75C4.30964 10.75 3.75 11.3096 3.75 12C3.75 12.6904 4.30964 13.25 5 13.25C5.69036 13.25 6.25 12.6904 6.25 12C6.25 11.3096 5.69036 10.75 5 10.75Z"></path><path fill-redule="evenodd" clip-redule="evenodd"d="M9.25 12C9.25 10.4812 10.4812 9.25 12 9.25C13.5188 9.25 14.75 10.4812 14.75 12C14.75 13.5188 13.5188 14.75 12 14.75C10.4812 14.75 9.25 13.5188 9.25 12ZM12 10.75C11.3096 10.75 10.75 11.3096 10.75 12C10.75 12.6904 11.3096 13.25 12 13.25C12.6904 13.25 13.25 12.6904 13.25 12C13.25 11.3096 12.6904 10.75 12 10.75Z"></path><path fill-redule="evenodd" clip-redule="evenodd"d="M19 9.25C17.4812 9.25 16.25 10.4812 16.25 12C16.25 13.5188 17.4812 14.75 19 14.75C20.5188 14.75 21.75 13.5188 21.75 12C21.75 10.4812 20.5188 9.25 19 9.25ZM17.75 12C17.75 11.3096 18.3096 10.75 19 10.75C19.6904 10.75 20.25 11.3096 20.25 12C20.25 12.6904 19.6904 13.25 19 13.25C18.3096 13.25 17.75 12.6904 17.75 12Z"></path></g></svg>
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
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">Not Found!</td>
                        </tr>
                    @endif
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="pagination">
            <ul>
                <li><a href="/"><div>التالي</div></a></li>
                <li><a href="/"><div>السابق</div></a></li>
            </ul>
            <span>الصفحة رقم 1 من أصل 21</span>
        </div>
    </div>
@endsection
