@extends('layouts.header')

@section('content')

    <div class="home my_row">
        <section class="my_row top_section">
            <div class="container">
                <header class="my_row">
                    <div class="my_row">
                        <img src={{asset('images/logo.png')}} alt="" />
                        <a class="button red" href={{route('login')}}>Login</a>
                    </div>
                </header>
                <div class="my_row heading_section">
                    <h2><span>Invite Only</span> messenger that puts security and <span>privacy first.</span></h2>
                    <a href="#free_for_everyone"><img src={{asset('images/down-arrow.png')}} alt="" /></a>
                </div>
            </div>
        </section>

        <div class="my_row overlap">
            <div class="container">

                <section id="free_for_everyone" class="my_row two_column_section">
                    <div class="column">
                        <img src={{asset('images/home-phone-img.png')}} alt="" />
                    </div>
                    <div class="column">
                        <h3><span>Free</span> for Everyone</h3>
                        <p>
                            All communication between members is completely free to use with no exceptions! Since we are an invite only messenger. Only those that receive an invitation will be able to chat with the invites that were previouly sent. If you have already received an invitation. click the view invite button at the top of the page to be connected.
                        </p>
                    </div>

                </section>

                <section class="my_row two_column_section swap_mobile">
                    <div class="column">
                        <h3><span>No trackers.</span> No kidding.</h3>
                        <p>
                            We take your privacy very seriouly. Our invite only messenger started from a need for secure private communication. Anything you say in our messenger is private and encrypted and will never be shared with anyone else!
                        </p>
                    </div>
                    <div class="column">
                        <img src={{asset('images/home-lock-img.png')}} alt="" />
                    </div>

                </section>

                <section class="my_row two_column_section">
                    <div class="column">
                        <img src={{asset('images/home-computer-img.png')}} alt="" />
                    </div>
                    <div class="column">
                        <h3><span>No ads.</span> Anywhere, period.</h3>
                        <p>
                            We are strong network of individuals that requires full private communication among our members. We established private commercial accounts to maintain our development and system while individual users that are invited from these networks can use our platform completely free, and free from advertising!
                        </p>
                    </div>

                </section>

            </div>
        </div>

        <footer class="my_row text-center">
            <p>&copy; Copyright 2022 All Rights Reserved.</p>
        </footer>
    </div>


@endsection
