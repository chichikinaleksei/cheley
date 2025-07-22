import React from 'react';
import PropTypes from 'prop-types';
import FeaturedImage from '../FeaturedImage';
import useSettingsContext from '../../context/useSettingsContext';
import useCore from '../../methods/core/useCore';
import useUtilities from '../../methods/utilities/useUtilities';
import useDataContext from '../../context/useDataContext';

function Post(props) {
  const {
    postType,
    displayAuthor,
    displayExcerpt,
    displayDate,
    displayCategories
  } = useSettingsContext();
  const { globalData } = useDataContext();

  const {post} = props;
  const {replaceSelected} = useCore();
  const {theExcerpt} = useUtilities();
  let categories;
  let categoryItems;
  let featuredImage;
  let author;
  let excerpt;
  let date;
  let image;

  Post.propTypes = {
    post: PropTypes.object
  }

  if (post.featured_image !== undefined && post.featured_image) {
    image = post.featured_image;
  } else {
    image = globalData.post_img_placeholder;
  }

  if (image !== undefined) {
    featuredImage = <a href={post.link} className="post-card__image">
      <figure>
        <FeaturedImage
          imageSize={'medium'}
          image={image}
          srcset={image}
        ></FeaturedImage>
      </figure>
    </a>
  }

  if (post.the_categories !== undefined && post.the_categories.length > 0) {
    categories = post.the_categories;
  }

  if (categories && displayCategories) {
    categoryItems = categories.map((category) => {
      if(category.taxonomy === 'category') {
        return (
          <a
            key={category.id}
            onClick={() => {replaceSelected(category.id, category.taxonomy)}}
            className={`eight29-taxonomy-${category.taxonomy}`}
          >{category.name}</a>
        );
      }
    });
  }

  if (post.the_author !== undefined && displayAuthor) {
    author = <p className="post-card__author">By {post.the_author}</p>
  }

  if (post.excerpt && displayExcerpt) {
    excerpt = <div className="eight29-post-excerpt" dangerouslySetInnerHTML={{__html: theExcerpt(post.excerpt.rendered, post.link)}}>
    </div>
  }

  if (displayDate) {
    date = <p className="post-card__date">{post.formatted_date}</p>
  }

  return (
    <article id={`${postType}-${post.id}`} className="post-card">
      {featuredImage}

      <div className="post-card__category">
       {categoryItems}
      </div>

      <h3 className="post-card__title"><a href={post.link} dangerouslySetInnerHTML={{__html: post.title.rendered}}></a></h3>

      {excerpt}

      {author}

      {date}
    </article>
  );
}

export default Post;