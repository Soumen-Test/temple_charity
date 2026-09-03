import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import Events from "../components/Events";

function EventsPage() {
  return (
    <>
      <Navbar />

      {/* Activity Page */}
      <div className="container-fluid hero-header">
        <div className="container">
          <div className="row">
            <div className="col-lg-7">
              <div className="hero-header-inner animated zoomIn">
                <h1 className="display-1 text-dark">Events </h1>

                <ol className="breadcrumb mb-0">
                  <li className="breadcrumb-item">Home</li>
                  <li className="breadcrumb-item">Pages</li>
                  <li className="breadcrumb-item active">Events</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Events />

      <Footer />
    </>
  );
}

export default EventsPage;