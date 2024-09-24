@extends('home.base')
@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{asset('home/images/background/5.jpg')}})">
        <div class="auto-container">
            <h2>{{$pageName}}</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>{{$pageName}}</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Start Terms of Service Area -->
    <section class="terms-of-service-area bg-f9f9f9 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="terms-of-service-content">
                        <p><i>This Terms of Service was last updated on January 1, 2022.</i></p>
                        <h3 class="text-center" style="font-weight: bolder;">Terms and Conditions </h3>
                        <p>Carefully read the rules for using the {{$siteName}} service. By accessing or using the site, you agree
                            to comply with the conditions described in this document. If you do not agree to these terms,
                            do not use this website.
                        </p>
                        <h3 class="text-center" style="font-weight: bolder;">Introduction</h3>
                        <p>
                            Welcome to {{$siteName}}s! These Terms and Conditions ("Terms") outline the rules and
                            guidelines that govern your use of our website, platform, products, and services.
                            By accessing or using our services, you agree to abide by these Terms. It is essential
                            to read and understand these Terms carefully before using any of our services. If you
                            have any questions or concerns, please contact us for clarification.
                            These Terms constitute a legal agreement between you and {{$siteName}}s, establishing the
                            rights and obligations of both parties. Your continued use of our services indicates
                            your acceptance and adherence to these Terms.
                        </p>
                        <h3 class="text-center" style="font-weight: bolder;">Foreword</h3>
                        <p>{{$siteName}} is an investment company specializing in Cryptocurrency trading and mining.
                            Our Services may develop over time. This means that we may make
                            changes, or replace  our Services at any time for any reason but with sufficient notice.
                        </p>
                        <p>
                            <b>
                                Registration and Account</b></p><br>
                        To access and use certain functions on the Site, you need to create an account in {{$siteName}}(“Account”). You agree to:<br>
                        1. Provide accurate, current and complete information when creating or updating an
                        Account;<br>
                        2. Maintain and timely update information about your Account;<br>
                        3. Maintain the security and privacy of your credentials and restrict access to your account
                        and your computer;<br>
                        4. Immediately notify {{$siteName}} if you discover or otherwise suspect any security breaches
                        associated with the Site;<br>
                        5. Enable two-step authentication using a mobile application<br>

                        <h3 class="text-center" style="font-weight: bolder;">Investment Policy</h3>
                        <b>
                            General Principles
                        </b>
                        <br>
                        <p>
                            Minin Assets is committed to providing investment services that prioritize transparency,
                            diligence, and client-centricity. Our investment policy is designed to guide our approach
                            and ensure that our clients' best interests are protected.
                        </p>
                        <p>
                            We believe in thorough research, analysis, and risk management when it comes to investment
                            decisions. Our goal is to provide our clients with well-informed recommendations that align
                            with their investment objectives, risk tolerance, and financial circumstances.
                        </p>
                        <p>
                            Investments in our Starter Plan minimum is limited to once. This means, you will need to increase
                            your investment capital if you desire to keep investing the Starter Plan.
                        </p>
                        <b>
                            Investment Objectives
                        </b>
                        <br>
                        <p>
                            Our primary objective is to help our clients achieve their investment goals while
                            minimizing risks. We strive to provide investment strategies and opportunities that
                            align with our clients' long-term growth objectives, capital preservation, or income
                            generation needs.
                        </p>
                        <p>
                            We prioritize diversification and asset allocation to mitigate risk and maximize potential
                            returns. Our investment team conducts extensive research and analysis to identify
                            investment opportunities across various asset classes, including but not limited to
                            cryptocurrencies, traditional equities, bonds, and alternative investments.
                        </p>
                        <b>
                            Risk Management
                        </b>
                        <br>
                        <p>
                            Minin Assets recognizes that all investments carry a certain degree of risk.
                            We are committed to implementing robust risk management practices to protect our
                            clients' capital and optimize risk-adjusted returns.
                        </p>
                        <p>
                            Our risk management approach includes ongoing monitoring of portfolio performance,
                            diversification across different investment types, asset allocation strategies, and regular
                            assessment of market conditions. We also consider our clients' risk tolerance and investment
                            preferences when formulating investment recommendations.
                        </p>

                        <b>
                            Due Diligence and Research
                        </b>
                        <br>
                        <p>
                            Minin Assets maintains a rigorous due diligence process to evaluate potential investment
                            opportunities. Our investment team conducts thorough research, including analysis of
                            market trends, financial statements, and regulatory factors, to assess the viability and
                            potential risks of each investment.
                        </p>
                        <p>
                            We rely on a combination of quantitative and qualitative analysis to identify investments
                            that align with our clients' objectives. This includes evaluating historical performance,
                            assessing the management team, analyzing industry trends, and considering macroeconomic
                            factors that may impact the investment's potential.
                        </p>
                        <b>
                            Client Communication and Reporting
                        </b>
                        <br>
                        <p>
                            Minin Assets values open and transparent communication with our clients. We strive to
                            provide regular updates and reports that offer insights into investment performance,
                            portfolio allocations, and market conditions.
                        </p>
                        <p>
                            Our clients can expect timely and comprehensive reporting that enables them to make
                            informed decisions about their investments. We are readily available to address any
                            questions or concerns that may arise regarding investment performance, strategy, or market
                            dynamics.
                        </p>
                        <h3 class="text-center" style="font-weight: bolder;">Privacy Policy</h3>
                        <br>
                        Please refer to our Privacy Policy for information on how we collect, use and share your
                        personal information.
                        <br>
                        <b>
                            Internet Data Privacy
                        </b><br>
                        Transmission of data or information (including e-mail) over the Internet or other public
                        networks is not 100% secure and may be lost, intercepted or altered during transport.
                        Accordingly, {{$siteName}} shall not be liable for any damages that you may incur or expenses that
                        you may incur as a result of any transmissions over the Internet or other public networks,
                        including without limitation of transmissions, including exchanging email with {{$siteName}}containing your personal data. Although {{$siteName}} will make commercially reasonable efforts to
                        protect the confidentiality of the information you provide to {{$siteName}} and processes such
                        information in accordance with the {{$siteName}} Privacy Policy, in no case will the information you
                        provide to {{$siteName}} be considered confidential, create any fiduciary obligations for you by {{$siteName}},
                        or lead to any liability to you by {{$siteName}} in the event of inadvertent disclosure of such
                        information by {{$siteName}} or access by a third persons without the consent of {{$siteName}}.<br><b>
                        <br>

                    </div>

                </div>
            </div>
    </section>
    <!-- End Terms of Service Area -->

@endsection
