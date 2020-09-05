@extends('templates.sub_pages_template')
@section('page-content')
<section class="breadcrumpsSection header_margin">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li><a href="{{url()}}">Home</a></li>
                    <li>FAQ</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="registrationFormSection">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 terms_conditions">
                <h1>FAQ</h1>
                <h3>What's the difference between QONDO and similar sites that list service suppliers ?</h3>
                <p>
                    QONDO has a vetting and pre-selection process that enables us to give our marketplace of buyers and service providers what they need: a solid base from which they can select a promising business transaction -- on one dashboard ! You don't need a grocery list of every service provider or potential buyer in your area. You want the serious ones who fit.
                </p>
                <p>If you're a service provider and you're looking for more efficient and effective marketing opportunities, check out our <a href="{{url('how-it-works')}}">business analytics</a>.</p>
                <h3>How does your vetting and pre-selection process work ?</h3>
                <p>We "hand-pick" our service providers by ensuring that their businesses are registered, they have got required certifications, and they've previously received high customer ratings. We not only support small local businesses, but also make the promise of providing our buyers with the highest reliability and lowest cost service providers,  Click <a href="{{url('suppliers-list')}}"> supplier directory</a> for our list of trusted providers.  </p>
                <h3>If I need to move cities/countries, how would I stop my subscription ? </h3>
                <p>You wouldn't need to ! QONDO's marketplace runs throughout Canada and the United States, so the only major change you need to make is your location on your account information. However, if you're planning on moving internationally or to an area where our networks cannot reach you, all you need is to <a href="{{url('contact-us')}}">contact us</a> and let us know your plans.</p>

                <h3>How does the pricing work ? </h3>
                <p>Buyers of services aren't required to pay a membership fee in order to submit requests. They just need to register in the system and then they're FREE to browse the website and look for service providers. Our free services for buyers also include access to our marketplace database and to import your own list of service suppliers or entirely use our marketplace database. Here, you can communicate with the providers directly via your dashboard, including those not in our database. Keep track of all of your contacts, ratings, messages, and organize your projects from planning to completion all from one dashboard.</p>
                <p>For companies that provide services, our pricing system depends on how much traffic you want for your business. It solely depends on how much of our marketing and analytics potential you want from QONDO. We can provide you variety of services, anywhere between a free page where people can see and read about your business, to keeping in close contact with you to ensure that you know exactly what your business is doing, who your business is talking to, and how it is doing in comparison to your competitive business environment. If you're curious, <a href="{{url('contact-us')}}">contact us</a> and we will have a QONDO representative provide you with a more in depth description of how we can help your business grow. </p>
                <p>How it works 
                    If you're looking for services in your local area, QONDO is a good place to start. With QONDO, you can apply to be free member From the backend, you can collect your list of local service providers, including those that are not registered in our database.  You can also communicate with the providers directly via your dashboard that is customizable. Keep track of all of your contacts, ratings, messages, and easily organize your quotes in one place. 
                    If you're a service provider looking to gain much better traffic for your business, QONDO can do that for you! As well, you can rest easy knowing that your business is sitting amongst other carefully vetted services, so potential customers visiting our marketplace will feel safe and free to read about your business and select it for quotes. 
                </p>
                <h3>Why should I use it ?</h3>
                <p>On top of the steady amount of traffic coming through the QONDO Marketplace, customer services representatives at QONDO will always available for you to contact and ask for marketing and analytics help <a href="{{url('contact-us')}}">contact us</a>. We know that it could be a handful and also expensive to come up with a unique marketing plan for your business. With QONDO, you get the best of both worlds: healthy traffic for your business that you can control, and reliable customer service that meets your standards.</p>
                <h3>How do I get an account ?</h3>
                <p>There's an orange TRY IT FREE button at the top right of your screen! Just click that, and a form will appear for you to fill out as step 1 of your profile. We will have a QONDO customer representative send you a confirmation email shortly. Once you get into the dashboard, you may start customizing the content only available to you! If you need any help with filling out your profile, just email us at <a href="mailto:info@qondo.com">info@qondo.com</a> or give us a call at <a href="Tel:+1 855 782 6882">+1 855 782 6882</a></p>
            </div>
        </div>
    </div>
</section>
@endsection