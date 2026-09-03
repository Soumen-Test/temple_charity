import React from "react";

function Activity() {
  return (
    <div className="container-fluid activities py-5">
      <div className="container py-5">
        <div
          className="mx-auto text-center mb-5 wow fadeIn"
          data-wow-delay="0.1s"
          style={{ maxWidth: "700px" }}
        >
          <p className="fs-5 text-uppercase text-primary">Activities</p>
          <h1 className="display-3">Here Are Our Activities</h1>
        </div>

        <div className="row g-4">
          <div className="col-lg-6 col-xl-4">
            <div className="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
              <i className="fa fa-university fa-4x text-dark"></i>
              <div className="ms-4">
                <h4>Temple Development</h4>
                <p className="mb-4">
                  Support the construction, renovation, and preservation of
                  Hindu temples to strengthen spiritual and cultural heritage.
                </p>
                <a href="/" className="btn btn-primary px-3">
                  Read More
                </a>
              </div>
            </div>
          </div>

          <div className="col-lg-6 col-xl-4">
            <div className="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
              <i className="fa fa-hand-holding-heart fa-4x text-dark"></i>
              <div className="ms-4">
                <h4>Charity & Seva</h4>
                <p className="mb-4">
                  Participate in selfless service (Seva) through food
                  distribution, donations, and community welfare initiatives.
                </p>
                <a href="/" className="btn btn-primary px-3">
                  Read More
                </a>
              </div>
            </div>
          </div>

          <div className="col-lg-6 col-xl-4">
            <div className="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
              <i className="fa fa-book fa-4x text-dark"></i>
              <div className="ms-4">
                <h4>Bhagavad Gita Learning</h4>
                <p className="mb-4">
                  Study the teachings of the Bhagavad Gita to understand Dharma,
                  devotion, and righteous living.
                </p>
                <a href="/" className="btn btn-primary px-3">
                  Read More
                </a>
              </div>
            </div>
          </div>

          <div className="col-lg-6 col-xl-4">
            <div className="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
              <i className="fa fa-om fa-4x text-dark"></i>
              <div className="ms-4">
                <h4>Vedas & Upanishads</h4>
                <p className="mb-4">
                  Explore the ancient scriptures that guide spiritual wisdom,
                  meditation, and philosophical understanding.
                </p>
                <a href="/" className="btn btn-primary px-3">
                  Read More
                </a>
              </div>
            </div>
          </div>

          <div className="col-lg-6 col-xl-4">
            <div className="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
              <i className="fa fa-users fa-4x text-dark"></i>
              <div className="ms-4">
                <h4>Cultural Education</h4>
                <p className="mb-4">
                  Teach children and families about Hindu traditions,
                  festivals, values, and cultural heritage.
                </p>
                <a href="/" className="btn btn-primary px-3">
                  Read More
                </a>
              </div>
            </div>
          </div>

          <div className="col-lg-6 col-xl-4">
            <div className="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
              <i className="fa fa-hands-helping fa-4x text-dark"></i>
              <div className="ms-4">
                <h4>Community Service</h4>
                <p className="mb-4">
                  Join volunteer programs that support the needy through
                  education, healthcare, and humanitarian services.
                </p>
                <a href="/" className="btn btn-primary px-3">
                  Read More
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Activity;