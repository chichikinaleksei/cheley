import React from "react";
import PropTypes from "prop-types";
import FeaturedImage from "../FeaturedImage";
import useSettingsContext from "../../context/useSettingsContext";
import useDataContext from "../../context/useDataContext";
import useCore from "../../methods/core/useCore";

function Activity(props) {
	const { postType, displayCategories } = useSettingsContext();
	const { globalData } = useDataContext();

	const { post, item, sliderRef } = props;
	const { replaceSelected } = useCore();
	let category;
	let categoryItem;
	let cardLabel;
	let featuredImage;
	let image;
	const itemNumber = `#${item}`;

	Activity.propTypes = {
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

	if (
		post.activity_category !== undefined &&
		post.activity_category.length > 0
	) {
		category = post.activity_category[0];
		category = post.the_categories.find((obj) => obj.id === category);
	}

	if (category && displayCategories) {
		categoryItem = (
			<p
				key={category.id}
				className="activity-card__category"
				onClick={() => {
					replaceSelected(category.id, category.taxonomy);
				}}
			>
				<span
					dangerouslySetInnerHTML={{
						__html: category.name,
					}}
				/>
			</p>
		);
	}

	function openLightbox(e) {
		e.preventDefault();

		const slideNum = parseInt(e.currentTarget.getAttribute('href').slice(1), 10);

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
				{categoryItem}
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

export default Activity;
