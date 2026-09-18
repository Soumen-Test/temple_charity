import React from "react";

import postImage from "../assets/img/blog2_550x400.jpg";
import postImage2 from "../assets/img/blog550x400.jpg";
import postImage3 from "../assets/img/blog3-550x400.jpg";

function Blog() {
  return (
    <div className="container-fluid py-5">
      <div className="container py-5">
        <h1 className="display-3 mb-5 wow fadeIn" data-wow-delay="0.1s">
          Latest From <span className="text-primary">Our Blog</span>
        </h1>

        <div className="row g-4 justify-content-center">

          {/* Blog 1 */}
          <div className="col-lg-6 col-xl-4">
            <div className="blog-item wow fadeIn" data-wow-delay="0.1s">
              <div className="blog-img position-relative overflow-hidden">
                <img
                  src={postImage}
                  className="img-fluid w-100"
                  alt="Blog 1"
                />
                <div className="bg-primary d-inline px-3 py-2 text-center text-white position-absolute top-0 end-0">
                  01 Jan 2045
                </div>
              </div>

              <div className="p-4">
                <div className="blog-meta d-flex justify-content-between pb-2">
                  <div>
                    <small>
                      <i className="fas fa-user me-2 text-muted"></i>
                      <a href="/" className="text-muted me-2">
                        By Admin
                      </a>
                    </small>

                    <small className="ms-2">
                      <i className="fa fa-comment-alt me-2 text-muted"></i>
                      <a href="/" className="text-muted">
                        12 Comments
                      </a>
                    </small>
                  </div>

                  <div>
                    <a href="/">
                      <i className="fas fa-bookmark text-muted"></i>
                    </a>
                  </div>
                </div>

                <a href="/" className="d-inline-block h4 lh-sm mb-3">
                  Importance of "Pillars" of Hinduism
                </a>

                <p className="mb-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, aliquip ex ea commodo consequat.
                </p>

                <a href="/" className="btn btn-primary px-3">
                  More Details
                </a>
              </div>
            </div>
          </div>

          {/* Blog 2 */}
          <div className="col-lg-6 col-xl-4">
            <div className="blog-item wow fadeIn" data-wow-delay="0.3s">
              <div className="blog-img position-relative overflow-hidden">
                <img
                  src={postImage2}
                  className="img-fluid w-100"
                  alt="Blog 2"
                />
                <div className="bg-primary d-inline px-3 py-2 text-center text-white position-absolute top-0 end-0">
                  01 Jan 2045
                </div>
              </div>

              <div className="p-4">
                <div className="blog-meta d-flex justify-content-between pb-2">
                  <div>
                    <small>
                      <i className="fas fa-user me-2 text-muted"></i>
                      <a href="/" className="text-muted me-2">
                        By Admin
                      </a>
                    </small>

                    <small className="ms-2">
                      <i className="fa fa-comment-alt me-2 text-muted"></i>
                      <a href="/" className="text-muted">
                        12 Comments
                      </a>
                    </small>
                  </div>

                  <div>
                    <a href="/">
                      <i className="fas fa-bookmark text-muted"></i>
                    </a>
                  </div>
                </div>

                <a href="/" className="d-inline-block h4 lh-sm mb-3">
                  How to Get Closer to Bhagavan
                </a>

                <p className="mb-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, aliquip ex ea commodo consequat.
                </p>

                <a href="/" className="btn btn-primary px-3">
                  More Details
                </a>
              </div>
            </div>
          </div>

          {/* Blog 3 */}
          <div className="col-lg-6 col-xl-4">
            <div className="blog-item wow fadeIn" data-wow-delay="0.5s">
              <div className="blog-img position-relative overflow-hidden">
                <img
                  src={postImage3}
                  className="img-fluid w-100"
                  alt="Blog 3"
                />
                <div className="bg-primary d-inline px-3 py-2 text-center text-white position-absolute top-0 end-0">
                  01 Jan 2045
                </div>
              </div>

              <div className="p-4">
                <div className="blog-meta d-flex justify-content-between pb-2">
                  <div>
                    <small>
                      <i className="fas fa-user me-2 text-muted"></i>
                      <a href="/" className="text-muted me-2">
                        By Admin
                      </a>
                    </small>

                    <small className="ms-2">
                      <i className="fa fa-comment-alt me-2 text-muted"></i>
                      <a href="/" className="text-muted">
                        12 Comments
                      </a>
                    </small>
                  </div>

                  <div>
                    <a href="/">
                      <i className="fas fa-bookmark text-muted"></i>
                    </a>
                  </div>
                </div>

                <a href="/" className="d-inline-block h4 lh-sm mb-3">
                  Importance of Prayer
                </a>

                <p className="mb-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, aliquip ex ea commodo consequat.
                </p>

                <a href="/" className="btn btn-primary px-3">
                  More Details
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
}

export default Blog;