import { Routes, Route } from "react-router-dom";

import Home from "./pages/Home";
import AboutPage from "./pages/About";
import ActivitiesPage from "./pages/Activities";
import EventsPage from "./pages/Events";
import SermonsPage from "./pages/Sermons";
import BlogsPage from "./pages/Blogs";
import TeamsPage from "./pages/Teams";
import Testimonial from "./pages/Testimonials";
import Contacts from "./pages/Contact";
function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
         <Route path="/about" element={<AboutPage />} />
         <Route path="/about" element={<AboutPage />} />
         <Route path="/activity" element={<ActivitiesPage />} />
         <Route path="/events" element={<EventsPage />} />
         <Route path="/sermons" element={<SermonsPage />} />
         <Route path="/blogs" element={<BlogsPage />} />
         <Route path="/team" element={<TeamsPage />} />
         <Route path="/testimonial" element={<Testimonial />} />
         <Route path="/contact" element={<Contacts />} />
    </Routes>
  );
}

export default App;