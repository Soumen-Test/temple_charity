import React from "react";

import postImage from "../assets/img/pyaer2-550x400.jpg";
import postImage2 from "../assets/img/pryer3-550x400.jpg";
import postImage3 from "../assets/img/prayer-550x400.jpg";

function Sermon() {
  return (
    <div className="container-fluid sermon py-5">
      <div className="container py-5">
        <div
          className="text-center mx-auto mb-5 wow fadeIn"
          data-wow-delay="0.1s"
          style={{ maxWidth: "700px" }}
        >
          <p className="fs-5 text-uppercase text-primary">
            Spiritual Discourses
          </p>
          <h1 className="display-3">Join The Hindu Community</h1>
        </div>

        <div className="row g-4 justify-content-center">

          {/* Sermon 1 */}
          <div className="col-lg-6 col-xl-4">
            <div className="sermon-item wow fadeIn" data-wow-delay="0.1s">
              <div className="overflow-hidden p-4 pb-0">
                <img
                  src={postImage}
                  className="img-fluid w-100"
                  alt="Sermon 1"
                />
              </div>

              <div className="p-4">
                <div className="sermon-meta d-flex justify-content-between pb-2">
                  <div>
                    <small>
                      <i className="fa fa-calendar me-2 text-muted"></i>
                      <a href="/" className="text-muted me-2">
                        13 Nov 2023
                      </a>
                    </small>

                    <small>
                      <i className="fas fa-user me-2 text-muted"></i>
                      <a href="/" className="text-muted">
                        Admin
                      </a>
                    </small>
                  </div>

                  <div>
                    <a href="/" className="me-1">
                      <i className="fas fa-video text-muted"></i>
                    </a>

                    <a href="/" className="me-1">
                      <i className="fas fa-headphones text-muted"></i>
                    </a>

                    <a href="/" className="me-1">
                      <i className="fas fa-file-alt text-muted"></i>
                    </a>

                    <a href="/">
                      <i className="fas fa-image text-muted"></i>
                    </a>
                  </div>
                </div>

                <a href="/" className="d-inline-block h4 lh-sm mb-3">
                  How to get closer to Vogoban
                </a>

                <p className="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, aliquip ex ea commodo consequat.
                </p>
              </div>
            </div>
          </div>

          {/* Sermon 2 */}
          <div className="col-lg-6 col-xl-4">
            <div className="sermon-item wow fadeIn" data-wow-delay="0.3s">
              <div className="overflow-hidden p-4 pb-0">
                <img
                  src={postImage2}
                  className="img-fluid w-100"
                  alt="Sermon 2"
                />
              </div>

              <div className="p-4">
                <div className="sermon-meta d-flex justify-content-between pb-2">
                  <div>
                    <small>
                      <i className="fa fa-calendar me-2 text-muted"></i>
                      <a href="/" className="text-muted me-2">
                        13 Nov 2023
                      </a>
                    </small>

                    <small>
                      <i className="fas fa-user me-2 text-muted"></i>
                      <a href="/" className="text-muted">
                        Admin
                      </a>
                    </small>
                  </div>

                  <div>
                    <a href="/" className="me-1">
                      <i className="fas fa-video text-muted"></i>
                    </a>

                    <a href="/" className="me-1">
                      <i className="fas fa-headphones text-muted"></i>
                    </a>

                    <a href="/" className="me-1">
                      <i className="fas fa-file-alt text-muted"></i>
                    </a>

                    <a href="/">
                      <i className="fas fa-image text-muted"></i>
                    </a>
                  </div>
                </div>

                <a href="/" className="d-inline-block h4 lh-sm mb-3">
                  Importance of Prayer
                </a>

                <p className="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, aliquip ex ea commodo consequat.
                </p>
              </div>
            </div>
          </div>

          {/* Sermon 3 */}
          <div className="col-lg-6 col-xl-4">
            <div className="sermon-item wow fadeIn" data-wow-delay="0.5s">
              <div className="overflow-hidden p-4 pb-0">
                <img
                  src={postImage3}
                  className="img-fluid w-100"
                  alt="Sermon 3"
                />
              </div>

              <div className="p-4">
                <div className="sermon-meta d-flex justify-content-between pb-2">
                  <div>
                    <small>
                      <i className="fa fa-calendar me-2 text-muted"></i>
                      <a href="/" className="text-muted me-2">
                        13 Nov 2023
                      </a>
                    </small>

                    <small>
                      <i className="fas fa-user me-2 text-muted"></i>
                      <a href="/" className="text-muted">
                        Admin
                      </a>
                    </small>
                  </div>

                  <div>
                    <a href="/" className="me-1">
                      <i className="fas fa-video text-muted"></i>
                    </a>

                    <a href="/" className="me-1">
                      <i className="fas fa-headphones text-muted"></i>
                    </a>

                    <a href="/" className="me-1">
                      <i className="fas fa-file-alt text-muted"></i>
                    </a>

                    <a href="/">
                      <i className="fas fa-image text-muted"></i>
                    </a>
                  </div>
                </div>

                <a href="/" className="d-inline-block h4 lh-sm mb-3">
                  Importance of "Pillars" of Hinduism
                </a>

                <p className="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, aliquip ex ea commodo consequat.
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
}

export default Sermon;