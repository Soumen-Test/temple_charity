import React from "react";

import postImage from "../assets/img/premanand-ji-maharaj-650x700.jpg";
import postImage2 from "../assets/img/astro-400x500.jpg";
import postImage3 from "../assets/img/astro-400x500.jpg";
import postImage4 from "../assets/img/astro-400x500.jpg";

function Team() {
  return (
    <div className="container-fluid team py-5">
      <div className="container py-5">
        <div
          className="text-center mx-auto mb-5 wow fadeIn"
          data-wow-delay="0.1s"
          style={{ maxWidth: "700px" }}
        >
          <p className="fs-5 text-uppercase text-primary">Our Team</p>
          <h1 className="display-3">Meet Our Organizer</h1>
        </div>

        <div className="row g-5">
          {/* Main Team Member */}
          <div className="col-lg-4 col-xl-5">
            <div className="team-img wow zoomIn" data-wow-delay="0.1s">
              <img src={postImage} className="img-fluid" alt="Premanand Ji Maharaj" />
            </div>
          </div>

          <div className="col-lg-8 col-xl-7">
            <div className="team-item wow fadeIn" data-wow-delay="0.1s">
              <h1>Premanand Ji Maharaj</h1>
              <h5 className="fw-normal fst-italic text-primary mb-4">
                President
              </h5>

              <p className="mb-4">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Aliquip ex ea commodo consequat.
              </p>

              <div className="team-icon d-flex pb-4 mb-4 border-bottom border-primary">
                <a className="btn btn-primary btn-lg-square me-2" href="/">
                  <i className="fab fa-facebook-f"></i>
                </a>

                <a className="btn btn-primary btn-lg-square me-2" href="/">
                  <i className="fab fa-twitter"></i>
                </a>

                <a className="btn btn-primary btn-lg-square me-2" href="/">
                  <i className="fab fa-instagram"></i>
                </a>

                <a className="btn btn-primary btn-lg-square" href="/">
                  <i className="fab fa-linkedin-in"></i>
                </a>
              </div>
            </div>

            <div className="row g-4">
              {/* Member 1 */}
              <div className="col-md-4">
                <div className="team-item wow zoomIn" data-wow-delay="0.2s">
                  <img
                    src={postImage2}
                    className="img-fluid w-100"
                    alt="Shuvo Adhikari"
                  />

                  <div className="team-content text-dark text-center py-3">
                    <div className="team-content-inner">
                      <h5 className="mb-0">Shuvo Adhikari</h5>
                      <p className="text-dark">Pujari</p>

                      <div className="team-icon d-flex align-items-center justify-content-center">
                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-facebook-f"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-twitter"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-instagram"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square" href="/">
                          <i className="fab fa-linkedin-in"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {/* Member 2 */}
              <div className="col-md-4">
                <div className="team-item wow zoomIn" data-wow-delay="0.4s">
                  <img
                    src={postImage3}
                    className="img-fluid w-100"
                    alt="Protty Nag"
                  />

                  <div className="team-content text-dark text-center py-3">
                    <div className="team-content-inner">
                      <h5 className="mb-0">Protty Nag</h5>
                      <p className="text-dark">Teacher</p>

                      <div className="team-icon d-flex align-items-center justify-content-center">
                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-facebook-f"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-twitter"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-instagram"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square" href="/">
                          <i className="fab fa-linkedin-in"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {/* Member 3 */}
              <div className="col-md-4">
                <div className="team-item wow zoomIn" data-wow-delay="0.6s">
                  <img
                    src={postImage4}
                    className="img-fluid w-100"
                    alt="Semon Acharjee"
                  />

                  <div className="team-content text-dark text-center py-3">
                    <div className="team-content-inner">
                      <h5 className="mb-0">Semon Acharjee</h5>
                      <p className="text-dark">Volunteer</p>

                      <div className="team-icon d-flex align-items-center justify-content-center">
                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-facebook-f"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-twitter"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square me-2" href="/">
                          <i className="fab fa-instagram"></i>
                        </a>

                        <a className="btn btn-primary btn-sm-square" href="/">
                          <i className="fab fa-linkedin-in"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {/* End Member */}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Team;