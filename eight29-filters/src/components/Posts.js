import React, { useRef, useState } from "react";
import Post from "./posts/Post";
import Staff from "./posts/Staff";
import Activity from "./posts/Activity";
import Pagination from "./Pagination";
import LoadMore from "./LoadMore";
import useSettingsContext from "../context/useSettingsContext";
import useDataContext from "../context/useDataContext";
import useCore from "../methods/core/useCore";
import Slider from "react-slick";
import SliderSlide from "./SliderSlide";

function Posts() {
  const { paginationStyle, postType, postsPerRowParameter } =
    useSettingsContext();
  const { posts, postTypes, loading } = useDataContext();
  const { resetSelected } = useCore();
  const noResultsText = "Sorry, no results.";
  const clearFiltersText = "Clear Filters";

  let sliderRef = useRef();

  //Post Type Components - Add post types and component names to this object
  const components = {
    post: Post,
    post_b: Post,
    post_c: Post,
    post_d: Post,
    staff: Staff,
    activity: Activity,
  };

  //By default each post type uses the Post component
  if (postTypes && postType) {
    if (components[postType] === undefined) {
      components[postType] = Post;
    }
  }

  const ThePost = components[postType];
  let postItems;
  let postsContainer;

  if (posts) {
    postItems = posts.map((post, index) => {
      return (
        <ThePost
          item={index}
          key={index}
          sliderRef={sliderRef}
          post={post}
        ></ThePost>
      );
    });
  }

  const loadingClass = loading ? "loading-active" : "";
  let postsContent;
  let paginationContent;

  if (paginationStyle === "more") {
    paginationContent = <LoadMore></LoadMore>;
  } else if (paginationStyle === "pagination") {
    paginationContent = <Pagination></Pagination>;
  }

  if (posts && posts.length > 0) {
    postsContent = (
      <div>
        <div
          className={`eight29-posts ${loadingClass}`}
          style={postsPerRowParameter}
        >
          {postItems}
        </div>

        {paginationContent}
      </div>
    );
  } else {
    if (!loading) {
      postsContent = (
        <div className="no-results">
          {noResultsText}

          <div className="c-btn-wrapper">
            <button
              className="c-btn c-btn-secondary c-btn-color-normal"
              onClick={() => {
                resetSelected();
              }}
            >
              {clearFiltersText}
            </button>
          </div>
        </div>
      );
    }
  }

  let slides;

  const sliderSettings = {
    dots: false,
    infinite: true,
    arrows: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    swipe: false,
    pauseOnHover: false,
    speed: 600,
    touchMove: false,
    fade: true,
  };

  function closeLightbox(e) {
    const lightboxWrapper = e.target.closest(".activities-lightbox");
    lightboxWrapper.classList.remove("active");
    document.body.style.overflow = "";
  }

  if (posts) {
    slides = posts.map((post, index) => {
      return <SliderSlide key={index} post={post}></SliderSlide>;
    });
  }

  if (postType === "activity") {
    postsContainer = (
      <div className="activities-lightbox-gallery">
        <section className="eight29-posts-container">{postsContent}</section>
        <div className="activities-lightbox">
          <button
            aria-label="Close Lightbox"
            className="activities-lightbox__close"
            onClick={(e) => {
              closeLightbox(e);
            }}
          >
            <span className="sr-only">Close Lightbox</span>
          </button>
          <div className="activities-lightbox__container">
            <Slider
              ref={sliderRef}
              {...sliderSettings}
              className="activities-lightbox__wrapper"
            >
              {slides}
            </Slider>
          </div>
        </div>
      </div>
    );
  } else if (postType === "staff") {
    postsContainer = (
      <div className="activities-lightbox-gallery">
        <section className="eight29-posts-container">{postsContent}</section>
        <div className="activities-lightbox">
          <button
            aria-label="Close Lightbox"
            className="activities-lightbox__close"
            onClick={(e) => {
              closeLightbox(e);
            }}
          >
            <span className="sr-only">Close Lightbox</span>
          </button>
          <div className="activities-lightbox__container">
            <Slider
              ref={sliderRef}
              {...sliderSettings}
              className="activities-lightbox__wrapper"
            >
              {slides}
            </Slider>
          </div>
        </div>
      </div>
    );
  } else {
    postsContainer = (
      <section className="eight29-posts-container">{postsContent}</section>
    );
  }

  return <>{postsContainer}</>;
}

export default Posts;
