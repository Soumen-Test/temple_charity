import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import Testimonial from "../components/Testimonial";
function TestimonialPage() {
  return (
    <>
      <Navbar />

      {/* Sermons Page */}
      <div className="container-fluid hero-header">
        <div className="container">
          <div className="row">
            <div className="col-lg-7">
              <div className="hero-header-inner animated zoomIn">
                <h1 className="display-1 text-dark">Testiminial </h1>

                <ol className="breadcrumb mb-0">
                  <li className="breadcrumb-item">Home</li>
                  <li className="breadcrumb-item">Pages</li>
                  <li className="breadcrumb-item active">Testiminial</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Testimonial />
      <Footer />
    </>
  );
}

export default TestimonialPage;