import React from "react";


import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
import About from "../components/About";
import Activity from "../components/Activity";
import Footer from "../components/Footer";
import Events from "../components/Events";
import Sermon from "../components/Sermon";
import Blog from "../components/Blog";
import Team from "../components/Team";
import Testimonial from "../components/Testimonial";

function Home() {
  return (
    <>
      <Navbar />
      <Hero />
      <About />
      <Activity />
      <Events />
      <Sermon />
      <Blog />
      <Team />
      <Testimonial />
      <Footer />
    </>
  );
}

export default Home;