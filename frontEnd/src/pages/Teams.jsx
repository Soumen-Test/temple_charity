import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import Teams from "../components/Team";

function TeamPage() {
  return (
    <>
      <Navbar />

      {/* Sermons Page */}
      <div className="container-fluid hero-header">
        <div className="container">
          <div className="row">
            <div className="col-lg-7">
              <div className="hero-header-inner animated zoomIn">
                <h1 className="display-1 text-dark">Latest Blog </h1>

                <ol className="breadcrumb mb-0">
                  <li className="breadcrumb-item">Home</li>
                  <li className="breadcrumb-item">Pages</li>
                  <li className="breadcrumb-item active">Latest Blog</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Teams />
      <Footer />
    </>
  );
}

export default TeamPage;