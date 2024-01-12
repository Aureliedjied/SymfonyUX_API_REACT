import React, { useState } from 'react';

export default function Search() { 
  const [search, setSearch] = useState('');
  const [searchResults, setSearchResults] = useState([]);
  const [isSearching, setIsSearching] = useState(false);

  const handleSearch = (e) => {
    setSearch(e.target.value);
    setIsSearching(true);
    fetch(`https://api.github.com/search/users?q=${e.target.value}`)
      .then((res) => res.json())
      .then((result) => {
        setSearchResults(result.items);
        setIsSearching(false);
      });
  };

  return (
    <div className="flex flex-col items-center justify-center min-h-screen py-2">
      <input
        type="text"
        placeholder="Search"
        className="border border-gray-300 p-2 rounded-md"
        value={search}
        onChange={handleSearch}
      />
      {isSearching && <div>Searching ...</div>}
      <div className="grid grid-cols-3 gap-4 mt-4">
        {searchResults.map((user) => (
          <div className="flex flex-col items-center justify-center" key={user.id}>
            <img src={user.avatar_url} alt={user.login} className="rounded-full w-24 h-24" />
            <a href={user.html_url} target="_blank" rel="noreferrer">
              {user.login}
            </a>
          </div>
        ))}
      </div>
    </div>
  );
}