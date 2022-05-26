
<x-guest-layout>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @php

            $username = $addUser != null ? $addUser : 'freakygrl269';
			$profileImage = $profile !== null ? $profile : asset('images/freakygrl1.jpg');
			$attachmentImage = $attachment !== null ? $attachment : asset('images/freakygrl4.jpg') ;
        @endphp
        <div class="content_wrap custom_four">

            <div class="messenger">

                <div class="messenger-listView">

                    <div class="m-header">
                        <nav>
                            <a href="#">
                                <svg class="svg-inline--fa fa-inbox fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="inbox" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
                                <span class="messenger-headTitle">MESSAGES</span>
                            </a>

                            <nav class="m-header-right">
                                <a href="#">
                                    <svg class="svg-inline--fa fa-cog fa-w-16 settings-btn" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path>
                                    </svg><!-- <i class="fas fa-cog settings-btn"></i> -->
                                </a>
                            </nav>
                        </nav>

                        <div class="messenger-listView-tabs">
                            <a href="#" class="active-tab" data-view="users">
                            </a>
                        </div>
                    </div>

                    <div class="m-body contacts-container">


                        <div class=" show  messenger-tab users-tab app-scroll" data-view="users">

                            <table class="messenger-list-item m-li-divider" data-contact="56653703">
                                <tbody><tr data-action="0">

                                    <td>
                                        <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                                            <svg class="svg-inline--fa fa-bookmark fa-w-12" style="font-size: 22px; color: #68a5ff; margin-top: calc(50% - 10px);" aria-hidden="true" focusable="false" data-prefix="far" data-icon="bookmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M336 0H48C21.49 0 0 21.49 0 48v464l192-112 192 112V48c0-26.51-21.49-48-48-48zm0 428.43l-144-84-144 84V54a6 6 0 0 1 6-6h276c3.314 0 6 2.683 6 5.996V428.43z"></path></svg><!-- <span class="far fa-bookmark" style="font-size: 22px; color: #68a5ff; margin-top: calc(50% - 10px);"></span> -->
                                        </div>
                                    </td>

                                    <td>
                                        <p data-id="56653703" data-type="user">Saved Messages <span>You</span></p>
                                        <span>Save messages secretly</span>
                                    </td>
                                </tr>
                                </tbody>

                            </table>

                            <div class="listOfContacts" style="width: 100%; height: auto; position: relative;">\
                                <table class="messenger-list-item m-list-active" data-contact="36327401">
                                    <tbody>
                                        <tr data-action="0">
                                            <td style="position: relative">
                                                <span class="activeStatus"></span>
                                                <div class="avatar av-m" style="background: url({{ $profileImage }}) no-repeat; background-size: cover;">
                                                </div>
                                            </td>

                                            <td>
                                                <p data-id="36327401" data-type="user">
                                                    {{$username}}
                                                    <span>now</span>
                                                </p>
                                                <span>I'm naked right now</span>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <table class="messenger-list-item" data-contact="36327401">
                                    <tbody>
                                    <tr data-action="0">
                                        <td style="position: relative">
                                            <span class="activeStatus"></span>
                                            <div class="avatar av-m" style="background: url({{ asset('images/SxyHotness.jpg') }}) no-repeat; background-size: cover;">
                                            </div>
                                        </td>

                                        <td>
                                            <p data-id="36327401" data-type="user">
                                                SxyHotness696
                                                <span>now</span>
                                            </p>
                                            <span>Sent you a photo</span>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                                <table class="messenger-list-item" data-contact="36327401">
                                    <tbody>
                                    <tr data-action="0">
                                        <td style="position: relative">
                                            <span class="activeStatus"></span>
                                            <div class="avatar av-m" style="background: url({{ asset('images/AloneNwett4u.jpg') }}) no-repeat; background-size: cover;">
                                            </div>
                                        </td>

                                        <td>
                                            <p data-id="36327401" data-type="user">
                                                AloneNwett4u
                                                <span>now</span>
                                            </p>
                                            <span>Call?</span>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="messenger-messagingView">

                    <div class="m-header m-header-messaging">
                        <nav>
                            <div style="display: inline-flex;">
                                <a href="#" class="show-listView">
                                    <svg class="svg-inline--fa fa-arrow-left fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
                                    </svg>
                                </a>
                                <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                                </div>
                                <a href="#" class="user-name">{{$username}}</a>
                            </div>

                            <nav class="m-header-right">
                                <a href="#" class="add-to-favorite">
                                    <svg class="svg-inline--fa fa-star fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="show-infoSide">
                                    <svg class="svg-inline--fa fa-info-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="info-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path
                                    </svg>
                                </a>
                            </nav>

                        </nav>
                    </div>

                    <div class="m-body messages-container app-scroll">
                        {{--<div class="messages" style="max-height: 718px;">
                            <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
                        </div>--}}
                        <div class="message-card" id="first_message">
                            <p>Hey there, are you all alone?
                                <sub title="2022-05-03 18:42:18">now</sub>
                            </p>
                        </div>
                        <div class="message-card" id="second_message">
                            <p>Look what I got for you ;)
                                <sub title="2022-05-03 18:42:18">now</sub>
                            </p>
                        </div>
                        <div id="third_message">
                            <div class="message-card empty">
                                <p>
                                    <sub title="2022-05-03 18:42:18">now</sub>
                                </p>
                            </div>
                            <div>
                                <div class="message-card">
                                    <!-- style="width: 250px; height: 150px; background-image: url();" -->
                                    <div class="image-file chat-image">
                                        <img src="{{$attachmentImage}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <form id="register_form" method="POST" action="{{ route('custom-email-register') }}">
                                <div class="heading my_row mb-4">
                                    <h2>{{$username}} sent you a private chat invite!</h2>
                                </div>
                                @csrf

                                <!-- UserName -->
                                <input id="add_chat_user" type="hidden" name="add_chat_user" value="{{$addUser}}"  />
                                <input id="src" type="hidden" name="src" value="{{$src}}"  />

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Email"/>
                                </div>

                                <div class="flex items-center justify-end mt-4 button_row">
                                    {{--<a class="underline text-sm" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>--}}

                                    <x-button class="ml-4">
                                        {{ __('Accept Invite') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>

                        <div class="typing-indicator">
                            <div class="message-card typing">
                                <p>
                                <span class="typing-dots">
                                    <span class="dot dot-1"></span>
                                    <span class="dot dot-2"></span>
                                    <span class="dot dot-3"></span>
                                </span>
                                </p>
                            </div>
                        </div>

                        <div class="messenger-sendCard">
                            <form id="message-form" method="POST" action="http://romeo.test/chat/sendMessage" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="nrzE2eriviPjMOSwvOx6vpRTLEs0bMnGEx6hR4X3">        <label>
                                    <svg class="svg-inline--fa fa-paperclip fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paperclip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z"></path>
                                    </svg>
                                    <input disabled="disabled" type="file" class="upload-attachment" name="file" accept="image/*, .txt, .rar, .zip">
                                </label>
                                <textarea readonly="readonly" name="message" class="m-send app-scroll" placeholder="Type a message.." style="overflow: hidden; overflow-wrap: break-word;"></textarea>
                                <button disabled="disabled">
                                    <svg class="svg-inline--fa fa-paper-plane fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"></path></svg>
                                    <!-- <span class="fas fa-paper-plane"></span> -->
                                </button>
                            </form>
                            <div class="my_row form_wrap register">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="messenger-infoView app-scroll">

                    <nav>
                        <a href="#">
                            <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
                            </svg>
                        </a>
                    </nav>
                    <div class="avatar av-l" style="background: url({{ $profileImage }}) no-repeat; background-size: cover;"></div>
                    <p class="info-name">{{$username}}</p>
                    <div class="messenger-infoView-btns">
                        <a href="#" class="danger delete-conversation">
                            <svg class="svg-inline--fa fa-trash-alt fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                            </svg>
                            Delete Conversation
                        </a>
                    </div>

                    <div class="messenger-infoView-shared">
                        <p class="messenger-title">shared photos</p>
                        <div class="shared-photos-list">
                            {{--<div class="shared-photo chat-image" style="background: url({{ asset('images/freakygrl2.jpg') }}) no-repeat; background-size: cover;"></div>
                            <div class="shared-photo chat-image" style="background: url({{ asset('images/freakygrl3.jpg') }}) no-repeat; background-size: cover;"></div>
                            <div class="shared-photo chat-image" style="background: url({{ asset('images/freakygrl4.jpg') }}) no-repeat; background-size: cover;"></div>--}}
                        </div>
                    </div>

                </div>
            </div>
        </div>


</x-guest-layout>
