import React, { useEffect, useState } from "react";

import postImage from "../assets/img/majestic-temple-sunset-stockcake-450x850.jpg";
import postImage2 from "../assets/img/Kedarnath_Temple_in_Rainy_season-450x450.jpg";
import postImage3 from "../assets/img/temp1125-450x450.jpg";
import postImage4 from "../assets/img/aboutchild200x200.jpg";

const defaultContent = {
  title: "About THE Temple",
  heading: "Vogoban Help Those Who Help Themselves",
  description:
    "Lorem ipsum dolor sit amet elit. Donec tempus eros vel dolor mattis aliquam. Etiam quis mauris justo. Vivamus purus nulla, rutrum ac risus in.",
  vision: {
    title: "Our Vision",
    description: "Lorem ipsum dolor sit amet tetur nod elit sed",
  },
  mission: {
    title: "Our Mission",
    description: "Lorem ipsum dolor sit amet tetur nod elit sed",
  },
  highlight_text:
    "Lorem ipsum dolor sit amet elit. Donec tempus eros vel dolor mattis aliquam. Etiam quis mauris justo.",
  raised_amount: "$20,46",
  raised_label: "Raised",
  features: [
    "Charity & Donation",
    "Parent Education",
    "Bhagavad Gita Learning",
    "Temple Development",
  ],
  callout_heading:
    "Every Hindu Should Understand the Spiritual Importance of Temples and Dharma",
  callout_button_text: "Learn More",
  callout_button_url: "",
  left_images: [
    { url: postImage, alt: "Temple at sunset" },
    { url: postImage2, alt: "Temple in rainy season" },
    { url: postImage3, alt: "Temple activity" },
  ],
};

function About() {
  const [content, setContent] = useState(defaultContent);

  useEffect(() => {
    const controller = new AbortController();
    const apiBaseUrl = process.env.REACT_APP_API_BASE_URL || "/api";
    const organizationId = process.env.REACT_APP_ORGANIZATION_ID || "1";

    async function loadAboutContent() {
      try {
        const response = await fetch(
          `${apiBaseUrl}/public/website-contents/about.temple?organization_id=${organizationId}`,
          { signal: controller.signal }
        );

        if (!response.ok) {
          return;
        }

        const payload = await response.json();
        const databaseContent = JSON.parse(payload.data.content_value);

        setContent((currentContent) => ({
          ...currentContent,
          ...databaseContent,
          // The standard WebsiteContent fields take precedence over JSON.
          title: payload.data.title || databaseContent.title || currentContent.title,
          description:
            payload.data.description ||
            databaseContent.description ||
            currentContent.description,
        }));
      } catch (error) {
        if (error.name !== "AbortError") {
          console.error("Unable to load About The Temple content.", error);
        }
      }
    }

    loadAboutContent();

    return () => controller.abort();
  }, []);

  return (
    <div className="container-fluid about py-5">
      <div className="container py-5">
        <div className="row g-5 mb-5">
          <div className="col-xl-6">
            <div className="row g-4">
              <div className="col-6">
                <img
                  src={content.left_images[0]?.url || postImage}
                  className="img-fluid h-100 wow zoomIn"
                  data-wow-delay="0.1s"
                  alt={content.left_images[0]?.alt || "Temple at sunset"}
                />
              </div>
              <div className="col-6">
                <img
                  src={content.left_images[1]?.url || postImage2}
                  className="img-fluid pb-3 wow zoomIn"
                  data-wow-delay="0.1s"
                  alt={content.left_images[1]?.alt || "Temple in rainy season"}
                />
                <img
                  src={content.left_images[2]?.url || postImage3}
                  className="img-fluid pt-3 wow zoomIn"
                  data-wow-delay="0.1s"
                  alt={content.left_images[2]?.alt || "Temple activity"}
                />
              </div>
            </div>
          </div>
          <div className="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
            <p className="fs-5 text-uppercase text-primary">{content.title}</p>
            <h2 className="display-5 pb-4 m-0">{content.heading}</h2>
            <p className="pb-4">{content.description}</p>
            <div className="row g-4 mb-4">
              <div className="col-md-6">
                <div className="ps-3 d-flex align-items-center justify-content-start">
                  <span className="bg-primary btn-md-square rounded-circle mt-4 me-2">
                    <i className="fa fa-eye text-dark fa-4x mb-5 pb-2" />
                  </span>
                  <div className="ms-4">
                    <h5>{content.vision.title}</h5>
                    <p>{content.vision.description}</p>
                  </div>
                </div>
              </div>
              <div className="col-md-6">
                <div className="ps-3 d-flex align-items-center justify-content-start">
                  <span className="bg-primary btn-md-square rounded-circle mt-4 me-2">
                    <i className="fa fa-flag text-dark fa-4x mb-5 pb-2" />
                  </span>
                  <div className="ms-4">
                    <h5>{content.mission.title}</h5>
                    <p>{content.mission.description}</p>
                  </div>
                </div>
              </div>
            </div>
            <div className="bg-light p-3 mb-4">
              <div className="row align-items-center justify-content-center">
                <div className="col-3">
                  <img
                    src={postImage4}
                    className="img-fluid rounded-circle"
                    alt="Temple community"
                  />
                </div>
                <div className="col-6">
                  <p className="mb-0">{content.highlight_text}</p>
                </div>
                <div className="col-3">
                  <h2 className="mb-0 text-primary text-center">{content.raised_amount}</h2>
                  <h5 className="mb-0 text-center">{content.raised_label}</h5>
                </div>
              </div>
            </div>
            <div className="row g-2">
              {content.features.map((feature) => (
                <div className="col-md-6" key={feature}>
                  <p className="mb-2">
                    <i className="fa fa-check text-primary me-3" />
                    {feature}
                  </p>
                </div>
              ))}
            </div>
          </div>
        </div>
        <div className="container text-center bg-primary py-5 wow fadeIn" data-wow-delay="0.1s">
          <div className="row g-4 align-items-center">
            <div className="col-lg-2">
              <i className="fa fa-place-of-worship fa-5x text-white" />
            </div>
            <div className="col-lg-7 text-center text-lg-start">
              <h1 className="mb-0">{content.callout_heading}</h1>
            </div>
            <div className="col-lg-3">
              <a href={content.callout_button_url} className="btn btn-light py-2 px-4">
                {content.callout_button_text}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default About;
