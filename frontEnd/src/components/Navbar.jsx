
 import React from "react";
 import { Link } from "react-router-dom";

function Navbar() {
  return (
    <div className="container-fluid fixed-top">
      {/* Top Bar */}
      <div className="container topbar d-none d-lg-block">
        <div className="topbar-inner">
          <div className="row gx-0">
            <div className="col-lg-7 text-start">
              <div className="h-100 d-inline-flex align-items-center me-4">
                <span className="fa fa-phone-alt me-2 text-dark"></span>
                <a href="/" className="text-secondary">
                  <span>+012 345 6789</span>
                </a>
              </div>

              <div className="h-100 d-inline-flex align-items-center">
                <span className="far fa-envelope me-2 text-dark"></span>
                <a href="/" className="text-secondary">
                  <span>info@example.com</span>
                </a>
              </div>
            </div>

            <div className="col-lg-5 text-end">
              <div className="h-100 d-inline-flex align-items-center">
                <span className="text-body">Follow Us:</span>

                <a className="text-dark px-2" href="/">
                  <i className="fab fa-facebook-f"></i>
                </a>

                <a className="text-dark px-2" href="/">
                  <i className="fab fa-twitter"></i>
                </a>

                <a className="text-dark px-2" href="/">
                  <i className="fab fa-linkedin-in"></i>
                </a>

                <a className="text-dark px-2" href="/">
                  <i className="fab fa-instagram"></i>
                </a>

                <a className="text-body ps-4" href="/">
                  <i className="fa fa-lock text-dark me-1"></i>
                  {" "}Signup / Login
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Navbar */}
      <div className="container">
        <nav className="navbar navbar-light navbar-expand-lg py-3">
          <a href="/" className="navbar-brand">
            <h1 className="mb-0">
              THE<span className="text-primary">Temple</span>
            </h1>
          </a>

          <button
            className="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="fa fa-bars text-primary"></span>
          </button>

          <div
            className="collapse navbar-collapse bg-white"
            id="navbarCollapse"
          >
            <div className="navbar-nav ms-lg-auto mx-xl-auto">
              <Link to="/" className="nav-item nav-link active">
                Home
              </Link>

              <Link to="/about" className="nav-item nav-link">
  About
</Link>

              <Link to="/activity" className="nav-item nav-link">
                Activities
              </Link>

              <Link to="/events" className="nav-item nav-link">
                Events
              </Link>

              <Link to="/sermons" className="nav-item nav-link">
                Sermons
              </Link>

              <div className="nav-item dropdown">
                <a
                  href="/"
                  className="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                >
                  Pages
                </a>

                <div className="dropdown-menu m-0 rounded-0">
                  <Link to="/blogs" className="dropdown-item">
                    Latest Blog
                  </Link>

                  <Link to="/team" className="dropdown-item">
                    Our Team
                  </Link>

                  <Link to="/testimonial" className="dropdown-item">
                    Testimonial
                  </Link>
                </div>
              </div>

              <Link to="/contact" className="nav-item nav-link">
                Contact
              </Link>
            </div>

            <a
              href="/donate"
              className="btn btn-primary py-2 px-4 d-none d-xl-inline-block"
            >
              Donate
            </a>
          </div>
        </nav>
      </div>
    </div>
  );
}

export default Navbar;