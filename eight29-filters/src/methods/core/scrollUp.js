function scrollUp(value) {
  const headerHeight = document.querySelector('.main-header').offsetHeight ? document.querySelector('.main-header').offsetHeight : 0;
  const archiveContainerPos = document.querySelector('.blog-archive-filters').getBoundingClientRect().top ? document.querySelector('.blog-archive-filters').getBoundingClientRect().top + window.scrollY : 0;
  const offset = (headerHeight && archiveContainerPos) ? 50 : 0;
  const scrollPos = archiveContainerPos - headerHeight - offset;

  const position = value ? value : scrollPos;

  window.scrollTo({
    top: position,
    left: 0,
    behavior: 'smooth'
  });
}

export default scrollUp;