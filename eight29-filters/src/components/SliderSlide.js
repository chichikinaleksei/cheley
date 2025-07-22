import React, { useRef } from "react";
import Slider from "react-slick";
import FeaturedImage from "./FeaturedImage";

function SliderSlide(props) {
  const { post } = props;
  const sliderRef = useRef();

  let slide;
  let cardLabel;
  let imageSlider;
  let imageSliderSlides;
  let category;
  let content;
  let categoryItem;
  let duration;
  let activitiesTitle;
  let activities;
  let activitiesItems;
  let slideCount = 0;

  let staffPosition;
  let staffCategories;
  let staffThumbnail;

  const sliderSettings = {
    dots: true,
    arrows: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    pauseOnHover: false,
    speed: 600,
    swipe: true,
    variableWidth: true,
  };

  if (post.acf_images_slider) {
    slideCount = post.acf_images_slider.length;
    imageSliderSlides = post.acf_images_slider.map((el, index) => {
      return (
        <div className="activities-lightbox-item__slider" key={index}>
          <figure
            className="activities-lightbox-item__slide"
            dangerouslySetInnerHTML={{ __html: el }}
          />
        </div>
      );
    });
  }

  // Stuff
  if (post.the_categories) {
    staffCategories = post.the_categories.map((category) => (
      <p
        className="activities-lightbox-item__duration"
        dangerouslySetInnerHTML={{
          __html: category.name,
        }}
      />
    ));
  }

  if (post.acf.position) {
    staffPosition = (
      <p
        className="activities-lightbox-item__category"
        dangerouslySetInnerHTML={{
          __html: post.acf.position,
        }}
      />
    );
  }
  if (post.featured_image) {
    staffThumbnail = (
      <FeaturedImage
        imageSize={"activity-card"}
        image={post.featured_image}
        srcset={post.featured_image}
      ></FeaturedImage>
    );
  }
  // Stuff

  if (post.acf.card_label) {
    cardLabel = (
      <p
        className="activities-lightbox-item__label"
        dangerouslySetInnerHTML={{
          __html: post.acf.card_label,
        }}
      />
    );
  }

  imageSlider = (
    <Slider
      ref={sliderRef}
      {...sliderSettings}
      className="activities-lightbox-item__slider"
    >
      {imageSliderSlides}
    </Slider>
  );

  if (
    post.activity_category !== undefined &&
    post.activity_category.length > 0
  ) {
    category = post.activity_category[0];
    category = post.the_categories.find((obj) => obj.id === category);
  }

  if (category) {
    categoryItem = (
      <p
        className="activities-lightbox-item__category"
        dangerouslySetInnerHTML={{
          __html: category.name,
        }}
      />
    );
  }

  if (post.acf.activity_duration) {
    duration = (
      <p
        className="activities-lightbox-item__duration"
        dangerouslySetInnerHTML={{
          __html: post.acf.activity_duration,
        }}
      />
    );
  }

  if (post.content.rendered) {
    content = (
      <div
        className="activities-lightbox-item__text"
        dangerouslySetInnerHTML={{
          __html: post.content.rendered,
        }}
      />
    );
  }

  if (post.acf.unit_availability_title) {
    activitiesTitle = (
      <div className="activities-lightbox-item__activities">
        <p
          className="activities-lightbox-item__activities-title"
          dangerouslySetInnerHTML={{
            __html: post.acf.unit_availability_title,
          }}
        />
      </div>
    );
  }

  if (post.acf.unit_availability_links) {
    activitiesItems = post.acf.unit_availability_links.map((el, index) => {
      return (
        <li key={index}>
          <a
            className="activities-lightbox-item__activities-lists-link"
            href={el.link.url}
            target={el.link.target}
          >
            <span className="c-btn-text">{el.link.title}</span>
          </a>
        </li>
      );
    });

    activities = (
      <ul className="is-style-default activities-lightbox-item__activities-lists">
        {activitiesItems}
      </ul>
    );
  }

  if (post.type === "staff") {
    slide = (
      <div className="activities-lightbox-item">
        <div className="activities-lightbox-item__content">
          <div className="activities-lightbox-item__content-wrapper">
            <div className="activities-lightbox-item__thumbnail">
              {staffThumbnail}
            </div>
            <div className="activities-lightbox-item__content-inner">
              {staffPosition}
              <h2
                className="activities-lightbox-item__title"
                dangerouslySetInnerHTML={{
                  __html: post.title.rendered,
                }}
              ></h2>
              <div
                className=""
                style={{
                  display: "flex",
                  gap: "0 20px",
                  flexDirection: "row",
                  alignItems: "flex-start",
                  marginBottom: "20px",
                }}
              >
                {staffCategories}
              </div>
              {duration}
              {content}
              {activitiesTitle}
              {activities}
            </div>
          </div>
        </div>
      </div>
    );
  } else {
    slide = (
      <div className="activities-lightbox-item">
        <div className="activities-lightbox-item__images">
          {cardLabel}
          {imageSlider}
        </div>
        <div className="activities-lightbox-item__content">
          <div className="activities-lightbox-item__content-wrapper">
            {categoryItem}
            <h2
              className="activities-lightbox-item__title"
              dangerouslySetInnerHTML={{
                __html: post.title.rendered,
              }}
            ></h2>
            {duration}
            {content}
            {activitiesTitle}
            {activities}
          </div>
        </div>
      </div>
    );
  }

  return <div className="activities-lightbox-item-wraper">{slide}</div>;
}

export default SliderSlide;
