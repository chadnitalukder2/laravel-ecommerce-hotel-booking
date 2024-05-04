    <!-- Inner Banner -->
        {{-- <div class="inner-banner inner-bg11">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Team</li>
                    </ul>
                    <h3>Team</h3>
                </div>
            </div>
        </div> --}}
    <!-- Inner Banner End -->
@php
    $team = App\Models\Team::latest()->get();
@endphp
        <!-- Team Style Area -->
        <div class="team-style-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span class="sp-color">TEAM</span>
                    <h2>Let's Meet Up With Our Special Team Members</h2>
                </div>
                <div class="team-slider-two owl-carousel owl-theme pt-45">
                       @foreach ($team as $item) 
                    <div class="col-lg-4 col-md-6">
                        <div class="team-item">
                            <a href="team.html">
                                <img src="assets/img/team/team-img1.jpg" alt="Images">
                            </a>
                         
                        </div>
                    </div>

                

                

                    <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">
                            <a href="#" class="prev page-numbers">
                                <i class='bx bx-chevrons-left'></i>
                            </a>

                            <span class="page-numbers current" aria-current="page">1</span>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers">3</a>
                            
                            <a href="#" class="next page-numbers">
                                <i class='bx bx-chevrons-right'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Style Area End -->