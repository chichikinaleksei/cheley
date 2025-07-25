import React, { useState } from 'react';
import PropTypes from 'prop-types';
import FilterContainer from './FilterContainer';
import DropdownContainer from './DropdownContainer';
import useSettingsContext from '../../context/useSettingsContext';
import useCore from '../../methods/core/useCore';
import useDataContext from '../../context/useDataContext';

function FilterAccordionSingleSelect(props) {
  const {
    taxonomy,
    taxSlug,
    label,
    collapsible,
    scrollable,
    dropdown
  } = props;

  const { displayPostCounts } = useSettingsContext();
  const { selected } = useDataContext();

  const { replaceSelected, isSelected, resetSelected } = useCore();
  const [closeRequest, setCloseRequest] = useState(false);
  const allTerms = [];
  const filterId = taxSlug ? `filter-${taxSlug}` : '';

  let parentContent;
  let childContent;
  let filterContent;

  const allTermsElement = {
    id: `${taxSlug}-all`,
  };

  FilterAccordionSingleSelect.propTypes = {
    taxonomy: PropTypes.array,
    taxSlug: PropTypes.string,
    label: PropTypes.string,
    collapsible: PropTypes.bool,
    scrollable: PropTypes.bool,
    dropdown: PropTypes.bool
  }

  function clickHandler(e, object) {
    e.preventDefault();
    replaceSelected(object.id, taxSlug);
  }

  function allClass() {
    let classString = '';

    if (selected.length === 0 || selected[taxSlug] !== undefined && selected[taxSlug].length === 0) {
      classString = 'active';
    }
    return classString;
  }

  function resetCat(e) {
    e.preventDefault();
    resetSelected();
  }

  function activeButtonClass(id) {
    let classString = '';

    if (isSelected(id, taxSlug)) {
      classString = 'active';
    }

    return classString;
  }

  if (taxonomy) {
    taxonomy.forEach(term => {
      if (displayPostCounts) {
        parentContent = `${term.name} (${term.count})`;
      }
      else {
        parentContent = term.name;
      }

      if (!term.hide_term) {
        allTerms.push(
          <li className="parent-term" key={term.id}>
            <button
              id={`${taxSlug}-${term.id}`}
              onClick={(e) => { clickHandler(e, term), setCloseRequest(true) }}
              className={activeButtonClass(term.id)}
            >
              <span dangerouslySetInnerHTML={{ __html: parentContent }}></span>
            </button>
          </li>
        )
      }

      if (term.children) {
        term.children.forEach(child => {
          if (displayPostCounts) {
            childContent = `${child.name} (${child.count})`;
          }
          else {
            childContent = child.name;
          }

          if (!child.hide_term) {
            allTerms.push(
              <li className="child-term" key={child.id}>
                <button
                  id={`${taxSlug}-${child.id}`}
                  onClick={(e) => { clickHandler(e, child), setCloseRequest(true) }}
                  className={activeButtonClass(child.id)}
                >
                  <span dangerouslySetInnerHTML={{ __html: childContent }}></span>
                </button>
              </li>
            )
          }
        });
      }
    });
  }

  allTerms.unshift(
    <li className='parent-term' key='all'>
      <button
        key={0}
        id={allTermsElement.id}
        onClick={(e) => {
          resetCat(e), setCloseRequest(true);
        }}
        className={allClass()}
      >
        <span dangerouslySetInnerHTML={{ __html: label }}></span>
      </button>
    </li>
  );

  if (dropdown) {
    filterContent = <DropdownContainer
      taxSlug={taxSlug}
      taxonomy={taxonomy}
      closeRequest={closeRequest}
      setCloseRequest={setCloseRequest}
      defaultLabel={label}
    >
      <ul id={`${filterId}-input`} className="dropdown-list">
        {allTerms}
      </ul>
    </DropdownContainer>
  }
  else {
    filterContent = <ul id={`${filterId}-input`}>
      {allTerms}
    </ul>
  }

  return (
    <FilterContainer
      className="filter-accordion-single-select"
      label={label}
      filterId={filterId}
      collapsible={collapsible}
      scrollable={scrollable}
    >
      {filterContent}
    </FilterContainer>
  )
}

export default FilterAccordionSingleSelect;