@section('css')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* Cải thiện giao diện overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 999;
        transition: background-color 0.3s ease;
    }

    /* Popup */
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        border-radius: 10px;
        display: none;
        max-width: 1000px;
        width: 90%;
        box-sizing: border-box;
    }

    /* Nút trong popup */
    .button-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .button-container .button {
        margin: 5px;
        padding: 12px 18px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: transform 0.3s ease, background-color 0.2s ease;
    }

    .button-container .button:hover {
        transform: scale(0.95);
    }

    /* Nút Upload */
    #uploadBtn {
        background-color: red;
        color: white;
        padding: 12px 30px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #uploadBtn:hover {
        background-color: royalblue;
    }

    /* Cải thiện form */
    .form-container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 8px;
    }

    /* Cải thiện các input fields */
    .form-control {
        border-radius: 8px;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        background-color: #f7f7f7;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Cải thiện nút submit */
    .btn-submit {
        width: auto;
        /* Nút Đăng ký có chiều rộng tự động */
        padding: 14px;
        font-size: 16px;
        background-color: #fa2828;
        color: white;
        border: none;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-submit:hover {
        background-color: #e62424;
        transform: scale(1.05);
    }

    /* Thông báo thành công và lỗi */
    .alert {
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 16px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    /* Responsive layout */
    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
        }
    }

    /* Flexbox cho các nút ở góc bên phải */
    .d-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endsection

@extends('layouts.app')

@section('content')
<main class="content" style="padding-top: 30px;">
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="form-container">

            {{-- Thông báo lỗi tổng quát --}}
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Thông báo thành công --}}
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('admin.admin_showRegisterForm') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title" id="addAccountModalLabel" style="text-align: center;">Thêm tài khoản mới</h2>
                </div>
                {{-- User Account --}}
                <div class="form-group">
                    <label for="useraccount">User Account</label>
                    <input type="text" class="form-control @error('useraccount') is-invalid @enderror" id="useraccount" name="useraccount" value="{{ old('useraccount') }}" required>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Level --}}
                <div class="form-group">
                    <label for="level">Level</label>
                    <select class="form-control @error('level') is-invalid @enderror" id="level" name="level" required>
                        <option value="" disabled selected>Chọn chức vụ</option>
                        <option value="1" @if(old('level')==1) selected @endif>Giám đốc</option>
                        <option value="2" @if(old('level')==2) selected @endif>Quản lý</option>
                        <option value="3" @if(old('level')==3) selected @endif>Kế toán</option>
                        <option value="4" @if(old('level')==4) selected @endif>Thủ tục đăng ký WIFI</option>
                        <option value="5" @if(old('level')==5) selected @endif>Thủ tục đăng ký SIM</option>
                        <option value="6" @if(old('level')==6) selected @endif>Kỹ thuật</option>
                        <option value="7" @if(old('level')==7) selected @endif>Đối tác (Người dùng hệ thống)</option>
                        <option value="8" @if(old('level')==8) selected @endif>Cộng tác viên đối tác</option>
                    </select>
                    @error('level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Các trường khác --}}
                @foreach(['business', 'telephonenumber', 'emailaddress', 'address', 'tax_number'] as $field)
                <div class="form-group">
                    <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                    <input type="text" class="form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" required>
                </div>
                @endforeach

                {{-- Manager --}}
                <div class="form-group">
                    <label for="id_manager">Manager</label>
                    <select class="form-control @error('id_manager') is-invalid @enderror" id="id_manager" name="id_manager" required>
                        @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" @if(old('id_manager')==$manager->id) selected @endif>{{ $manager->name_manager }}</option>
                        @endforeach
                    </select>
                    @error('id_manager')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Nút Back và Nút Đăng ký --}}
                <div class="d-flex justify-content-between" style="margin-top: 30px;">
                    {{-- Nút Back --}}
                    <a href="javascript:history.back()"  style="padding: 8px 20px; font-size: 14px;">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>

                    {{-- Nút Đăng ký --}}
                    <button type="submit" class="btn-submit">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection