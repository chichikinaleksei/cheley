import React from "react";
import PropTypes from "prop-types";
import FeaturedImage from "../FeaturedImage";
import useSettingsContext from "../../context/useSettingsContext";
import useDataContext from "../../context/useDataContext";

function Staff(props) {
  const { postType } = useSettingsContext();
  const { globalData } = useDataContext();

  const { post, item, sliderRef } = props;
  let cardLabel;
  let featuredImage;
  let image;
  const itemNumber = `#${item}`;

  Staff.propTypes = {
    post: PropTypes.object,
  };

  if (post.featured_image !== undefined && post.featured_image) {
    image = post.featured_image;
  } else {
    image = globalData.post_img_placeholder;
  }

  if (image) {
    featuredImage = (
      <a
        href={itemNumber}
        onClick={(e) => {
          openLightbox(e);
        }}
        className="activity-card__image-link"
      >
        <figure className="activity-card__image">
          <FeaturedImage
            imageSize={"activity-card"}
            image={image}
            srcset={image}
          ></FeaturedImage>
        </figure>
      </a>
    );
  }

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

  function openLightbox(e) {
    e.preventDefault();

    const slideNum = parseInt(
      e.currentTarget.getAttribute("href").slice(1),
      10
    );

    sliderRef.current.slickGoTo(slideNum, true);

    const lightboxBlock = e.currentTarget.closest(
      ".activities-lightbox-gallery"
    );

    lightboxBlock.querySelector(".activities-lightbox").classList.add("active");

    document.body.style.overflow = "hidden";
  }

  return (
    <article id={`${postType}-${post.id}`} className="activity-card">
      <div className="activity-card__header">
        {cardLabel}
        {featuredImage}
      </div>
      <div className="activity-card__content">
        <p className="activity-card__category">
          <span>{post.acf.position}</span>
        </p>
        <a
          href={itemNumber}
          onClick={(e) => {
            openLightbox(e);
          }}
          className="activity-card__title-link"
        >
          <h4
            className="activity-card__title"
            dangerouslySetInnerHTML={{
              __html: post.title.rendered,
            }}
          ></h4>
        </a>
      </div>
    </article>
  );
}

export default Staff;
