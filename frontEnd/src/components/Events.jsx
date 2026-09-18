import React from "react";
 import postImage from "../assets/img/dewali.jpg";
import postImage2 from "../assets/img/ganesh-chaturthi.jpg";
import postImage3 from "../assets/img/holi2.jpg";
function Events() {
  return (
   
      <div className="container-fluid event py-5">
            <div className="container py-5">
                <h1 className="display-3 mb-5 wow fadeIn" data-wow-delay="0.1s">Upcoming <span className="text-primary">Events</span></h1>
                <div className="row g-4 event-item wow fadeIn" data-wow-delay="0.1s">
                    <div className="col-3 col-lg-2 pe-0">
                        <div className="text-center border-bottom border-dark py-3 px-2">
                            <h6>01 Jan 2045</h6>
                            <p className="mb-0">Fri 06:55</p>
                        </div>
                    </div>
                    <div className="col-9 col-lg-6 border-start border-dark pb-5">
                        <div className="ms-3">
                            <h4 className="mb-3">Diwali Celebrations</h4>
                            <p className="mb-4">Diwali, the Festival of Lights, symbolizes the victory of light over darkness, good over evil, and knowledge over ignorance. It is celebrated with prayers, lamps, family gatherings, and acts of charity. </p>
                            <a href="/" className="btn btn-primary px-3">Join Now</a>
                        </div>
                    </div>
                    <div className="col-12 col-lg-4">
                        <div className="overflow-hidden mb-5">
                            <img src="{postImage}" className="img-fluid w-100" alt=""/>
                        </div>
                    </div>
                </div>
                <div className="row g-4 event-item wow fadeIn" data-wow-delay="0.3s">
                    <div className="col-3 col-lg-2 pe-0">
                        <div className="text-center border-bottom border-dark py-3 px-2">
                            <h6>01 Jan 2045</h6>
                            <p className="mb-0">Wed 11:30</p>
                        </div>
                    </div>
                    <div className="col-9 col-lg-6 border-start border-dark pb-5">
                        <div className="ms-3">
                            <h4 className="mb-3">Ganesh Chaturthi Celebration</h4>
                            <p className="mb-4"> Worship Lord Ganesha, the remover of obstacles and the god of wisdom, prosperity, and new beginnings. Devotees offer prayers, flowers, sweets, and seek His blessings for success and happiness.</p>
                            <a href="/" className="btn btn-primary px-3">Join Now</a>
                        </div>
                    </div>
                    <div className="col-12 col-lg-4">
                        <div className="overflow-hidden mb-5">
                            <img src="{postImage2}" className="img-fluid w-100" alt=""/>
                        </div>
                    </div>
                </div>
                <div className="row g-4 event-item wow fadeIn" data-wow-delay="0.5s">
                    <div className="col-3 col-lg-2 pe-0">
                        <div className="text-center border-bottom border-dark py-3 px-2">
                            <h6>01 Jan 2045</h6>
                            <p className="mb-0">Thu 11:30</p>
                        </div>
                    </div>
                    <div className="col-9 col-lg-6 border-start border-dark pb-5">
                        <div className="ms-3">
                            <h4 className="mb-3">Holi Celebration</h4>
                            <p className="mb-4"> Celebrate Holi, the Festival of Colors, with joy, devotion, and togetherness. The festival symbolizes the victory of good over evil and welcomes the arrival of spring. </p>
                            <a href="#" className="btn btn-primary px-3">Join Now</a>
                        </div>
                    </div>
                    <div className="col-12 col-lg-4">
                        <div className="overflow-hidden mb-5">
                            <img src="{postImage3}" className="img-fluid w-100" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
  );
}

export default Events;