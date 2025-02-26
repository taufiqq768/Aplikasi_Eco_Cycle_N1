<div class="position-relative" style="height: 100vh;">
    <div class="d-xl-block d-none">
        <div class="position-absolute top-0 start-0">
            <img src="{{ asset('assets/images/self/Ellipse 14.png') }}" alt="" style="width: 48vw;">
        </div>
        <div class="position-absolute top-0 start-0">
            <img src="{{ asset('assets/images/self/eco cycle title.png') }}" alt="" style="width: 30vw;">
        </div>
        <div class="position-absolute top-0 start-0" style="padding-top: 25vh; padding-left: 10vh;">
            <img src="{{ asset('assets/images/self/recycle title.png') }}" alt="" style="width: 35vw;">
        </div>

        <div class="position-absolute top-50 end-0 translate-middle-y" style="margin-right: 30vh;">
            <div class="card" style="width: 25vw; overflow: hidden; position: relative;">
                <div class="position-absolute" style="top: 10vh; z-index: 1; left: 10vh;">
                    <img src="{{ asset('assets/images/self/recycle title.png') }}" alt=""
                        style="width: 25vw; opacity: 0.3;">
                </div>
                <div class="card-body mb-5" style="position: relative; z-index: 2;">
                    {{-- <h3 class="mb-4" style="color: #5F9548">Login</h3> --}}
                    <div class="d-flex justify-content-center align-items-start mb-3">
                        <img src="{{ asset('assets/images/self/eco cycle green.png') }}" alt="" height="100vh"
                            class="d-block mx-auto">
                    </div>
                    <form wire:submit='formSubmit'>
                        <div class="mb-3">
                            <input type="text" name="username" id="username" class="form-control form-control-lg"
                                wire:model="username" placeholder="NIK SAP" style="border: 1px solid #5F9548;">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                placeholder="Password" style="border: 1px solid #5F9548;" wire:model='password'>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-lg w-100" style="background-color: #5F9548;">
                                <h5 class="mb-0 text-white">Login</h5>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="d-block d-xl-none">
        <div class="row position-relative" style="height: 100vh;">
            <div class="position-absolute top-0 start-0 px-0">
                <img src="{{ asset('assets/images/self/Ellipse 14.png') }}" alt="" style="width: 80vw;">
            </div>

            <div class="position-absolute" style="top: 10%; left: 50%; transform: translate(-50%, -50%);">
                <img src="{{ asset('assets/images/self/eco cycle title.png') }}" alt="" style="width: 50vw;">
            </div>

            <div class="d-flex justify-content-center align-items-center w-100" style="min-height: 100vh;">
                <div class="card position-relative"
                    style="width: 80vw; max-width: 400px; overflow: hidden; padding: 20px;">
                    <div class="position-absolute" style="bottom: -10vh; right: -10vh; z-index: 1;">
                        <img src="{{ asset('assets/images/self/recycle title.png') }}" alt=""
                            style="width: 70vw; opacity: 0.2;">
                    </div>
                    <div class="card-body" style="position: relative; z-index: 2;">
                        <div class="d-flex justify-content-center align-items-start mb-3">
                            <img src="{{ asset('assets/images/self/eco cycle green.png') }}" alt=""
                                height="100vh" class="d-block mx-auto">
                        </div>
                        <form wire:submit='formSubmitMobile'>
                            <div class="mb-3">
                                <input type="text" name="username_mobile" id="username_mobile"
                                    class="form-control form-control-lg" placeholder="NIK SAP"
                                    style="border: 1px solid #5F9548;" wire:model='username_mobile'>
                                @error('username_mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password_mobile" id="password_mobile"
                                    class="form-control form-control-lg" placeholder="Password"
                                    style="border: 1px solid #5F9548;" wire:model='password_mobile'>
                                @error('password_mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-lg w-100" style="background-color: #5F9548;">
                                    <h5 class="mb-0 text-white">Login</h5>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
