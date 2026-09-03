import React from "react";

function Contact() {
  return (
    <div className="container-fluid contact py-5">
      <div className="container py-5">
        <div
          className="text-center mx-auto mb-5 wow fadeIn"
          data-wow-delay="0.1s"
          style={{ maxWidth: "700px" }}
        >
          <p className="fs-5 text-uppercase text-primary">
            Get In Touch
          </p>

          <h1 className="display-3">
            Contact For Any Queries
          </h1>

          <p className="mb-0">
            The contact form is currently inactive
          </p>
        </div>

        <div
          className="row g-4 wow fadeIn"
          data-wow-delay="0.3s"
        >
          <div className="col-sm-6">
            <input
              type="text"
              className="form-control bg-transparent p-3"
              placeholder="Your Name"
            />
          </div>

          <div className="col-sm-6">
            <input
              type="email"
              className="form-control bg-transparent p-3"
              placeholder="Your Email"
            />
          </div>

          <div className="col-12">
            <input
              type="text"
              className="form-control bg-transparent p-3"
              placeholder="Subject"
            />
          </div>

          <div className="col-12">
            <textarea
              className="w-100 form-control bg-transparent p-3"
              rows="6"
              cols="10"
              placeholder="Your Message"
            ></textarea>
          </div>

          <div className="col-12 text-center">
            <button
              className="btn btn-primary border-0 py-3 px-5"
              type="button"
            >
              Send Message
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Contact;