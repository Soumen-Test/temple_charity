import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import Activity from "../components/Activity";
import Team from "../components/Team";
import Testimonial from "../components/Testimonial";

function ActivitiesPage() {
  return (
    <>
      <Navbar />

      {/* Activity Page */}
      <div className="container-fluid hero-header">
        <div className="container">
          <div className="row">
            <div className="col-lg-7">
              <div className="hero-header-inner animated zoomIn">
                <h1 className="display-1 text-dark">Activities </h1>

                <ol className="breadcrumb mb-0">
                  <li className="breadcrumb-item">Home</li>
                  <li className="breadcrumb-item">Pages</li>
                  <li className="breadcrumb-item active">Activities</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Activity />
      <Testimonial />

      <Footer />
    </>
  );
}

export default ActivitiesPage;