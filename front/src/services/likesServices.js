import {basePath} from "./basePath";
const pathLikes = basePath + 'likes' ;

export const getLikes = async (url='') => {
    return await fetch(pathLikes + '?' + + url, {
      // headers: {authorization: 'Bearer ' + localStorage.getItem('token')}
    });
};

export const getLikesId = async (id) => {
  return await fetch(pathLikes + '/' + id, {
    // headers: {authorization: 'Bearer ' + localStorage.getItem('token')}
  });
}

export const patchAcceptLikes = async (id) => {
    return await fetch(pathLikes + '/' + id, {
        method: 'PATCH',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/merge-patch+json',
            // authorization: `Bearer ${localStorage.getItem('token')}` ,
        },
        body: JSON.stringify({
          isPending: false,
          isValidate: true
        })
    });
}

export const patchRejectLikes = async (id) => {
  return await fetch(pathLikes + '/' + id, {
      method: 'PATCH',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/merge-patch+json',
          // authorization: `Bearer ${localStorage.getItem('token')}` ,
      },
      body: JSON.stringify({
        isPending: false,
        isValidate: false
      })
  });
}

// export const calculateAgeAnimal = (birthday) => {
//     const age = new Date().getYear() - birthday;
//     console.log(age);
//     return age;
// }