import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import About from "../components/About";
import Team from "../components/Team";

function AboutPage() {
  return (
    <>
      <Navbar />

      {/* About Page Hero */}
      <div className="container-fluid hero-header">
        <div className="container">
          <div className="row">
            <div className="col-lg-7">
              <div className="hero-header-inner animated zoomIn">
                <h1 className="display-1 text-dark">About Us</h1>

                <ol className="breadcrumb mb-0">
                  <li className="breadcrumb-item">Home</li>
                  <li className="breadcrumb-item">Pages</li>
                  <li className="breadcrumb-item active">About</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <About />
      <Team />

      <Footer />
    </>
  );
}

export default AboutPage;