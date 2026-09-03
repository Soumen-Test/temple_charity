
 import React from "react";
 
 import postImage from "../assets/img/majestic-temple-sunset-stockcake-450x850.jpg";
import postImage2 from "../assets/img/Kedarnath_Temple_in_Rainy_season-450x450.jpg";
import postImage3 from "../assets/img/temp1125-450x450.jpg";
import postImage4 from "../assets/img/aboutchild200x200.jpg";

function About() {
  return (
 
      <div className="container-fluid about py-5">
            <div className="container py-5">
                <div className="row g-5 mb-5">
                    <div className="col-xl-6">
                        <div className="row g-4">
                            <div className="col-6">
                                <img src={postImage} className="img-fluid h-100 wow zoomIn" data-wow-delay="0.1s" alt=""/>
                            </div>
                            <div className="col-6">
                                <img src={postImage2} className="img-fluid pb-3 wow zoomIn" data-wow-delay="0.1s" alt=""/>
                                <img src={postImage3} className="img-fluid pt-3 wow zoomIn" data-wow-delay="0.1s" alt=""/>
                            </div>
                        </div>
                    </div>
                    <div className="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
                        <p className="fs-5 text-uppercase text-primary">About THE Temple</p>
                        <h2 className="display-5 pb-4 m-0">Vogoban Help Those Who Help Themselves</h2>
                        <p className="pb-4">Lorem ipsum dolor sit amet elit. Donec tempus eros vel dolor mattis aliquam. Etiam quis mauris justo. Vivamus purus nulla, rutrum ac risus in.</p>
                        <div className="row g-4 mb-4">
                            <div className="col-md-6">
                                <div className="ps-3 d-flex align-items-center justify-content-start">
                                    <span className="bg-primary btn-md-square rounded-circle mt-4 me-2"><i className="fa fa-eye text-dark fa-4x mb-5 pb-2"></i></span>
                                    <div className="ms-4">
                                        <h5>Our Vision</h5>
                                        <p>Lorem ipsum dolor sit amet tetur nod elit sed</p>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="ps-3 d-flex align-items-center justify-content-start">
                                    <span className="bg-primary btn-md-square rounded-circle mt-4 me-2"><i className="fa fa-flag text-dark fa-4x mb-5 pb-2"></i></span>
                                    <div className="ms-4">
                                        <h5>Our Mission</h5>
                                        <p>Lorem ipsum dolor sit amet tetur nod elit sed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="bg-light p-3 mb-4">
                            <div className="row align-items-center justify-content-center">
                                <div className="col-3">
                                    <img src="src={postImage4}" class="img-fluid rounded-circle" alt=""/>
                                </div>
                                <div className="col-6">
                                    <p className="mb-0">Lorem ipsum dolor sit amet elit. Donec tempus eros vel dolor mattis aliquam. Etiam quis mauris justo.</p>
                                </div>
                                <div className="col-3">
                                        <h2 className="mb-0 text-primary text-center">$20,46</h2>
                                        <h5 className="mb-0 text-center">Raised</h5>
                                </div>
                            </div>
                        </div>
                        <div className="row g-2">
                            <div class="col-md-6">
                                <p className="mb-2"><i class="fa fa-check text-primary me-3"></i>Charity & Donation</p>
                                <p className="mb-0"><i class="fa fa-check text-primary me-3"></i>Parent Education</p>
                            </div>
                            <div className="col-md-6">
                                <p className="mb-2"><i className="fa fa-check text-primary me-3"></i>Bhagavad Gita Learning</p>
                                <p className="mb-0"><i className="fa fa-check text-primary me-3"></i>Temple Development</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="container text-center bg-primary py-5 wow fadeIn" data-wow-delay="0.1s">
                    <div className="row g-4 align-items-center">
                      <div className="col-lg-2">
                            <i className="fa fa-place-of-worship fa-5x text-white"></i>
                        </div>

                        <div className="col-lg-7 text-center text-lg-start">
                            <h1 className="mb-0">Every Hindu Should Understand the Spiritual Importance of Temples and Dharma</h1>
                        </div>
                        <div className="col-lg-3">
                            <a href="" className="btn btn-light py-2 px-4">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
  );
}

export default About;