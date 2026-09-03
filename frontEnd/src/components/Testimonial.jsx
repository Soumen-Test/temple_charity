import React from "react";

import postImage from "../assets/img/bageshwar-dham-sarkar-150x150.jpg";
import postImage2 from "../assets/img/479f729aa1f76c8ada24421d26433625-150x150.jpg";
import postImage3 from "../assets/img/RAMBABA-150x150.jpg";
import postImage4 from "../assets/img/article-2024513320340274042000-150x150.jpg";

function Testimonial() {
  return (
    <div className="container-fluid testimonial py-5">
      <div className="container py-5">

        <div
          className="text-center mx-auto mb-5 wow fadeIn"
          data-wow-delay="0.1s"
          style={{ maxWidth: "700px" }}
        >
          <p className="fs-5 text-uppercase text-primary">
            Testimonial
          </p>

          <h1 className="display-3">
            What People Say About Hinduism
          </h1>
        </div>

        <div
          className="owl-carousel testimonial-carousel wow fadeIn"
          data-wow-delay="0.1s"
        >

          {/* Testimonial 1 */}
          <div className="testimonial-item">
            <div className="d-flex mb-3">
              <div className="position-relative">
                <img
                  src={postImage}
                  className="img-fluid"
                  alt="Bageshwar Dham"
                />

                <div
                  className="btn-md-square bg-primary rounded-circle position-absolute"
                  style={{ top: "25px", left: "-25px" }}
                >
                  <i className="fa fa-quote-left text-dark"></i>
                </div>
              </div>

              <div className="ps-3 my-auto">
                <h5 className="mb-0">Full Name</h5>
                <p className="m-0">Profession</p>
              </div>
            </div>

            <div className="testimonial-content">
              <div className="d-flex">
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
              </div>

              <p className="fs-5 m-0 pt-3">
                Lorem ipsum dolor sit amet elit, sed do tempor ut labore et
                dolore magna aliqua. Ut enim ad minim quis.
              </p>
            </div>
          </div>

          {/* Testimonial 2 */}
          <div className="testimonial-item">
            <div className="d-flex mb-3">
              <div className="position-relative">
                <img
                  src={postImage2}
                  className="img-fluid"
                  alt="Testimonial"
                />

                <div
                  className="btn-md-square bg-primary rounded-circle position-absolute"
                  style={{ top: "25px", left: "-25px" }}
                >
                  <i className="fa fa-quote-left text-dark"></i>
                </div>
              </div>

              <div className="ps-3 my-auto">
                <h5 className="mb-0">Full Name</h5>
                <p className="m-0">Profession</p>
              </div>
            </div>

            <div className="testimonial-content">
              <div className="d-flex">
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
              </div>

              <p className="fs-5 m-0 pt-3">
                Lorem ipsum dolor sit amet elit, sed do tempor ut labore et
                dolore magna aliqua. Ut enim ad minim quis.
              </p>
            </div>
          </div>

          {/* Testimonial 3 */}
          <div className="testimonial-item">
            <div className="d-flex mb-3">
              <div className="position-relative">
                <img
                  src={postImage3}
                  className="img-fluid"
                  alt="Ram Baba"
                />

                <div
                  className="btn-md-square bg-primary rounded-circle position-absolute"
                  style={{ top: "25px", left: "-25px" }}
                >
                  <i className="fa fa-quote-left text-dark"></i>
                </div>
              </div>

              <div className="ps-3 my-auto">
                <h5 className="mb-0">Full Name</h5>
                <p className="m-0">Profession</p>
              </div>
            </div>

            <div className="testimonial-content">
              <div className="d-flex">
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
              </div>

              <p className="fs-5 m-0 pt-3">
                Lorem ipsum dolor sit amet elit, sed do tempor ut labore et
                dolore magna aliqua. Ut enim ad minim quis.
              </p>
            </div>
          </div>

          {/* Testimonial 4 */}
          <div className="testimonial-item">
            <div className="d-flex mb-3">
              <div className="position-relative">
                <img
                  src={postImage4}
                  className="img-fluid"
                  alt="Article"
                />

                <div
                  className="btn-md-square bg-primary rounded-circle position-absolute"
                  style={{ top: "25px", left: "-25px" }}
                >
                  <i className="fa fa-quote-left text-dark"></i>
                </div>
              </div>

              <div className="ps-3 my-auto">
                <h5 className="mb-0">Full Name</h5>
                <p className="m-0">Profession</p>
              </div>
            </div>

            <div className="testimonial-content">
              <div className="d-flex">
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
                <i className="fas fa-star text-primary"></i>
              </div>

              <p className="fs-5 m-0 pt-3">
                Lorem ipsum dolor sit amet elit, sed do tempor ut labore et
                dolore magna aliqua. Ut enim ad minim quis.
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
}

export default Testimonial;