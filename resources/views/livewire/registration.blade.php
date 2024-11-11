<div class="registration my-5 px-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-8 {{$this->role == \App\Models\User::ROLE_ADVISER ? 'd-none' : ''}}">
            <div class="organizations js-organization p-4 pt-0">
                <div class="row justify-content-center text-center">
                    <div class="col-12 mb-3">
                        <h4 class="text-center mb-3">Choose the school organization you'd like to be part of.</h4>
                    </div>
                    @forelse($organizations as $organization)
                        @if($organization->course_id == $course_id || $organization->course_id === null)
                            <div wire:key="{{$organization->id}}" class="col-lg-3 col-4">
                                <img wire:click="selectOrg({{$organization->id}},'{{$organization->name}}')" src="{{$this->getLogo($organization->id)}}" data-name="{{$organization->name}}" data-id="{{$organization->id}}" class="organization-item js-select-org" alt="org-logo"/>
                                <p class="text-uppercase pt-1">{{$organization->name}}</p>
                            </div>
                        @endif
                    @empty:
                    <div class="col-12">
                        <h4>No Organizations yet.</h4>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-4">
            <div class="registration__form js-registration-form">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Profile Information') }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="organization-selected rounded text-uppercase {{$this->role == \App\Models\User::ROLE_ADVISER ? 'd-none' : ''}}">
                            <span class="font-weight-bold">{{$selected_org}}</span>
                        </p>
                        @error('organization_id')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                        <form wire:submit="save" role="form text-left">
                            @csrf
                            <input wire:model="organization_id" type="hidden" name="organization_id" value="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                        <input wire:model="email" class="form-control" value="" type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">{{ __('Firstname') }}</label>
                                        <input wire:model="name" class="form-control" value="" type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="lastname" class="form-control-label">{{ __('Lastname') }}</label>
                                        <input wire:model="lastname" class="form-control" value="" type="text" placeholder="Lastname" id="lastname" name="lastname">
                                        @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="course" class="form-control-label">{{ __('Course') }}</label>
                                        <div class="@error('course_id')border border-danger rounded-3 @enderror">
                                            <select wire:model.change="course_id" id="course_id" class="form-select">
                                                <option value=""></option>
                                                @foreach($courses as $course)
                                                    <option value="{{$course->id}}">{{$course->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role" class="form-control-label">{{ __('Choose Account Type') }}</label>
                                        <div class="@error('role') border border-danger rounded-3 @enderror">
                                            <select wire:model.change="role" id="role" class="form-select text-capitalize">
                                                <option value="{{\App\Models\User::ROLE_STUDENT}}">{{\App\Models\User::ROLE_STUDENT}}</option>
                                                <option value="{{\App\Models\User::ROLE_ADVISER}}">{{\App\Models\User::ROLE_ADVISER}}</option>

                                            </select>
                                            @error('role')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">{{ __('Phone') }}</label>
                                        <div class="@error('phone')border border-danger rounded-3 @enderror input-group">
                                            <span class="input-group-text" id="phone_number">+63</span>
                                            <input wire:model="phone" class="form-control" aria-describedby="phone_number" type="number" placeholder="9077088844">
                                        </div>
                                    </div>
                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="password" class="form-control-label">{{ __('Password') }}</label>
                                    <input wire:model="password" type="password" class="form-control" autocomplete="off" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input wire:model="agree_terms" type="checkbox" id="agree_terms" class="form-check-input"/>
                                        <label for="agree_terms" class="form-check-label">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#termsAndConditions" class="text-info text-gradient font-weight-bold">
                                                Please confirm that you agree to our terms and conditions.
                                            </a>
                                        </label>
                                    </div>
                                    @error('agree_terms')
                                        <p class="text-danger">Agree to the terms and conditions before proceeding.</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-1 flex-lg-row flex-md-column flex-sm-row flex-wrap">
                                <button wire:click="validateForm" type="button" class="btn bg-gradient-dark btn-md mt-4 mb-4 js-register-send-otp">Register</button>
                                <a href="{{ url('login') }}">Already have an account ?</a>
                            </div>
                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="otpModalLabel">Verify Email</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>You will receive a Verification Code on your email.</p>
                                            <input wire:model="otp_input" type="text" class="form-control form-control-sm {{! is_null($this->otpValidated) && !$this->otpValidated ? 'border-danger' : ''}}" />
                                            @if(! is_null($this->otpValidated) && !$this->otpValidated)
                                                <p class="text-danger">Invalid code.</p>
                                            @endif
                                            <p class="text-muted">OTP not received?
                                                <a href="javascript:;" class="js-otp-resend">Resend</a>
                                                <span class="js-otp-resend-timer">60</span>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" wire:click="validateOtp">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="termsAndConditions" tabindex="-1" role="dialog" aria-labelledby="termsAndConditions" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div>
                        <h1 class="display-5">Terms and Conditions</h1>
                        <p><strong>Effective Date:</strong> {{date('F Y')}}</p>

                        <p>Welcome to BCC Organization Portal (the “Website”), the official portal for [School Organization Name] members and advisers. By accessing and using this Website, you agree to abide by these Terms and Conditions. Please read them carefully. If you do not agree with any part of these Terms, please discontinue using the Website.</p>

                        <h2 class="display-6">1. User Registration and Information Collection</h2>
                        <p>1.1. By registering on the Website, you agree to provide accurate and complete information, including your first name, last name, email address, phone number, and course.</p>
                        <p>1.2. The information collected will be used solely for the purpose of managing user accounts, notifying students about events, and enhancing user experience within the organization.</p>

                        <h2 class="display-6">2. User Responsibilities and Account Management</h2>
                        <p>2.1. Users must maintain the security of their accounts and keep their login details confidential.</p>
                        <p>2.2. Users are responsible for updating their personal information to ensure it remains accurate and up-to-date.</p>
                        <p>2.3. Any misuse of the Website or unauthorized access to another user’s account is strictly prohibited.</p>

                        <h2 class="display-6">3. Role of Students and Advisers</h2>
                        <p>3.1. Students and advisers can manage their accounts, view upcoming events, and receive notifications about organizational activities.</p>
                        <p>3.2. Advisers have additional permissions, including the ability to post events, which will notify registered students about new activities or updates.</p>

                        <h2 class="display-6">4. Event Posting and Notifications</h2>
                        <p>4.1. Advisers are responsible for ensuring the accuracy and timeliness of event information posted on the Website.</p>
                        <p>4.2. Registered students and members will receive notifications whenever a new event is posted, as well as an automatic event reminder one day before the event starts.</p>
                        <p>4.3. The Website disclaims responsibility for users missing any events due to non-receipt of notifications.</p>

                        <h2 class="display-6">5. Privacy Policy</h2>
                        <p>5.1. The collection and processing of user data will comply with the Philippine Data Privacy Act (Republic Act No. 10173). Please refer to our Privacy Policy [link to Privacy Policy] for more information on how your data is collected, used, and protected.</p>
                        <p>5.2. The Website will not sell or share user information with third parties, except as required by law or as necessary to fulfill the services provided.</p>

                        <h2 class="display-6">6. Intellectual Property</h2>
                        <p>6.1. All content on the Website, including text, graphics, logos, and software, is the property of [School Organization Name] and is protected by applicable copyright and trademark laws.</p>
                        <p>6.2. Users may not reproduce, distribute, or otherwise exploit any part of the Website content without prior written permission.</p>

                        <h2 class="display-6">7. Limitation of Liability</h2>
                        <p>7.1. The Website is provided on an "as-is" and "as-available" basis. BCC Organization Portal makes no guarantees regarding the Website's availability, accuracy, or completeness.</p>
                        <p>7.2. BCC Organization Portal disclaims all liability for any loss or damages arising from the use or inability to use the Website, including but not limited to data loss, service interruptions, and technical issues.</p>

                        <h2 class="display-6">8. Termination of Access</h2>
                        <p>8.1. BCC Organization Portal reserves the right to suspend or terminate user access to the Website at any time for violating these Terms or engaging in inappropriate or illegal behavior.</p>
                        <p>8.2. Users may also request account deactivation by contacting the Website administrator.</p>

                        <h2 class="display-6">9. Changes to Terms and Conditions</h2>
                        <p>9.1. We reserve the right to update these Terms and Conditions at any time. Any changes will be posted on this page, and it is your responsibility to review these Terms periodically. Your continued use of the Website constitutes acceptance of the updated Terms.</p>

                        <h2 class="display-6">10. Governing Law</h2>
                        <p>These Terms and Conditions shall be governed by and construed in accordance with the laws of the Philippines. Any disputes arising from these Terms shall be subject to the exclusive jurisdiction of the courts in the Philippines.</p>

                        <h2 class="display-6">11. Contact Information</h2>
                        <p>For questions or concerns regarding these Terms, please contact us at <b>bccorganizationportal@gmail.com</b>.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        let time = 10;
        Livewire.on('verify-phone-num', () => {
            $('#otpModal').modal('show');
            let otpTimer = setInterval(function () {
                if (time <= 0) {
                    clearInterval(otpTimer);
                    $('.js-otp-resend-timer').text('');
                } else {
                    $('.js-otp-resend-timer').text(time);
                }
                time--;
            }, 1000);
        });

        $('.js-otp-resend').on('click', function() {
            const lw = Livewire.find('{{$this->getId()}}');

            if (time <= 0) {
                time = 10
                lw.dispatch('resend-otp')
            }
        });

        $('.js-register-send-otp').on('click', function () {
            $(this).attr('disabled', 'disabled');
        });

        document.getElementById('otpModal').addEventListener('hidden.bs.modal', function (event) {
            $('.js-register-send-otp').removeAttr('disabled');
        })

        Livewire.on('opt-validated', () => {
            $('#otpModal').modal('hide');
        });

    </script>
@endscript
