/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./assets/src/js/course-review-v2.js ***!
  \*******************************************/
let controller;
const loadSignal = () => {
  if (undefined !== controller) {
    controller.abort();
  }
  controller = new AbortController();
  return controller.signal;
};
const loadNonceParam = paramsFetch => {
  if (0 !== parseInt(lpData.user_id)) {
    paramsFetch = {
      ...paramsFetch,
      headers: {
        'X-WP-Nonce': lpData.nonce
      }
    };
  }
  return paramsFetch;
};
const closePopupWriteReview = () => {
  const btnClose = document.querySelectorAll('#review-form .close');
  if (btnClose === null) return;

  //const modal = document.getElementById('course-review-overlay');
  const form = document.querySelector('.course-review-wrapper');
  if (!form) {
    return;
  }
  for (let i = 0; i < btnClose.length; i++) {
    const btn = btnClose[i];
    btn.addEventListener('click', e => {
      e.preventDefault();
      //modal.classList.remove('active');
      form.classList.remove('active');
    });
  }
};
const addReviewStar = () => {
  const reviewForm = document.querySelector('.review-form');
  if (!reviewForm) {
    return;
  }
  const reviewStar = reviewForm.querySelector('ul.review-stars');
  if (!reviewStar) {
    return;
  }
  const stars = reviewStar.querySelectorAll('li.review-title');
  let clicked = false;
  const addClassReview = (stars, title) => {
    [...stars].map(starHover => {
      const titleHover = starHover.getAttribute('title');
      if (titleHover <= title) {
        starHover.querySelector('span').classList.add('hover');
      } else {
        starHover.querySelector('span').classList.remove('hover');
      }
    });
  };
  stars && stars.forEach((star, index) => {
    const title = star.getAttribute('title');
    star.addEventListener('mouseover', () => {
      if (!clicked) {
        addClassReview(stars, title);
      }
    });
    star.addEventListener('click', () => {
      clicked = true;
      addClassReview(stars, title);
      document.querySelector('ul.review-fields li.review-actions input[name="rating"]').value = title;
    });
  });
  reviewStar.addEventListener('mouseout', () => {
    stars.forEach(starHover => {
      !clicked && starHover.querySelector('span').classList.remove('hover');
    });
  });
  closePopupWriteReview();
};
const courseReviewSkeleton = () => {
  //loader template tab
  const skeletonTab = () => {
    const elementCourseReview = document.querySelector('.learnpress-course-review');
    if (!elementCourseReview) {
      return;
    }
    const course_id = elementCourseReview.dataset.id;
    getResponse(elementCourseReview, course_id);
  };
  const getResponse = (ele, course_id = 0) => {
    const skeleton = ele.querySelector('.lp-skeleton-animation');
    let signal = loadSignal();
    const url = `${lpData.lp_rest_url}lp/v1/review/rating-comment/course/${course_id}`;
    let paramsFetch = {
      method: 'GET'
    };
    paramsFetch = loadNonceParam(paramsFetch);

    // console.log( 'load' );

    fetch(url, {
      ...paramsFetch,
      signal
    }).then(response => response.json()).then(response => {
      //console.log( response );
      if (response.status === 'error') {
        throw new Error(response.message || 'Error');
      }
      let data = response.data;
      data && ele.insertAdjacentHTML('beforeend', data);
    }).catch(error => {
      console.log(error);
      ele.insertAdjacentHTML('beforeend', `<div class="lp-ajax-message error" style="display:block">${error || 'Error: Query lp/v1/lazy-load/course-review'}</div>`);
    }).finally(() => {});
    skeleton && skeleton.remove();

    //popup write review

    closePopupWriteReview();

    // Temporary fix for theme.
    const elReviewStarsRated = document.querySelectorAll('.review-stars-rated');
    if (elReviewStarsRated) {
      elReviewStarsRated.forEach(el => {
        el.style.display = 'flex';
      });
    }
    const elReviewStars = document.querySelectorAll('.review-stars-rated');
    if (elReviewStars) {
      elReviewStarsRated.forEach(el => {
        el.style.position = 'relative';
      });
    }
    // End
  };
  skeletonTab();
  const submitReview = btnReviewForm => {
    const form = btnReviewForm.closest('form');
    const parenNode = form.querySelector('ul.review-fields');
    if (!parenNode) {
      return;
    }
    const reviewTitle = parenNode.querySelector('input[name="review_title"]').value || '';
    const reviewContent = parenNode.querySelector('textarea[name="review_content"]').value || '';
    const rating = Number(parenNode.querySelector('input[name="rating"]').value || 0);
    const courseID = btnReviewForm.dataset.id;
    const emptyTitle = parenNode.querySelector('input[name="empty_title"]').value;
    const emptyContent = parenNode.querySelector('input[name="empty_content"]').value;
    const emptyRating = parenNode.querySelector('input[name="empty_rating"]').value;
    if (0 === reviewTitle.length) {
      alert(emptyTitle);
      return;
    }
    if (0 === reviewContent.length) {
      alert(emptyContent);
      return;
    }
    if (0 === rating) {
      alert(emptyRating);
      return;
    }
    btnReviewForm.classList.add('loading');
    let signal = loadSignal();
    const url = `${lpData.lp_rest_url}lp/v1/review/submit`;
    let formData = new FormData();
    formData.append('id', courseID);
    formData.append('rate', rating);
    formData.append('title', reviewTitle);
    formData.append('content', reviewContent);
    let paramsFetch = {
      method: 'POST',
      body: formData
    };
    paramsFetch = loadNonceParam(paramsFetch);
    fetch(url, {
      ...paramsFetch,
      signal
    }).then(response => response.json()).then(response => {
      //console.log( response );
      if (response.status === 'error') {
        throw new Error(response.message || 'Error');
      }
      btnReviewForm.classList.remove('loading');
      window.location.reload();
    }).catch(error => {
      console.log(error);
      parenNode.innerHTML += `<li class="lp-ajax-message error" style="display:block">${error}</li>`;
    }).finally(() => {});
  };
  const showMoreReview = (ele, id, page, btnLoadReview = false) => {
    let signal = loadSignal();
    const url = `${lpData.lp_rest_url}lp/v1/review/course/${id}/?page=${page}&show_template=1`;
    let paramsFetch = {
      method: 'GET'
    };
    paramsFetch = loadNonceParam(paramsFetch);
    fetch(url, {
      ...paramsFetch,
      signal
    }).then(response => response.json()).then(response => {
      //console.log( response );
      if (response.status === 'error') {
        throw new Error(response.message || 'Error');
      }
      let data = response.data;
      // data && ele.insertAdjacentHTML( 'beforeend', data );
      ele.innerHTML += data.template;
      if (btnLoadReview) {
        btnLoadReview.classList.remove('loading');
        const paged = btnLoadReview.dataset.paged;
        const numberPage = btnLoadReview.dataset.number;
        if (numberPage === paged) {
          btnLoadReview.remove();
        }
        btnLoadReview.dataset.paged = parseInt(paged) + 1;
      }

      // Temporary fix for theme.
      const elReviewStarsRated = document.querySelectorAll('.review-stars-rated');
      if (elReviewStarsRated) {
        elReviewStarsRated.forEach(el => {
          el.style.display = 'flex';
        });
      }
    }).catch(error => {
      console.log(error);
      ele.innerHTML += `<li class="lp-ajax-message error" style="display:block">${error && error}</li>`;
    }).finally(() => {});
  };
  document.addEventListener('click', function (e) {
    const btnLoadReview = document.querySelector('.course-review-load-more');
    if (btnLoadReview && btnLoadReview.contains(e.target)) {
      btnLoadReview.classList.add('loading');
      const paged = btnLoadReview && btnLoadReview.dataset.paged;
      const courseID = btnLoadReview && btnLoadReview.dataset.id;
      const element = document.querySelector('.course-reviews-list');
      showMoreReview(element, courseID, paged, btnLoadReview);
    }
    const btnReviewForm = document.querySelector('li.review-actions .submit-review');
    if (btnReviewForm && btnReviewForm.contains(e.target)) {
      submitReview(btnReviewForm);
    }
    if (e.target.classList.contains('write-a-review')) {
      const form = document.querySelector('.course-review-wrapper');
      if (!form) {
        return;
      }

      // Event add review.
      addReviewStar();

      //modal.classList.add('active');
      form.classList.add('active');
    }
  });
};
document.addEventListener('DOMContentLoaded', function () {
  courseReviewSkeleton();
});
/******/ })()
;
//# sourceMappingURL=course-review-v2.js.map