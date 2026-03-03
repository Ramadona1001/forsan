@extends('layouts.app')

@section('title', __('profile.conversations') . ' - ' . config('app.name'))


@section('content')
    <section class="profile">
        <div class="container">
            <div class="profile__header">
                <button class="navbar-toggler shadow-none main-button main-primary fill" type="button" 
                        data-bs-toggle="offcanvas" data-bs-target="#navbarUser">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <div class="row">
                <!-- Sidebar -->
                <div class="col-xl-4">
                    <div class="offcanvas-xl offcanvas-start" id="navbarUser">
                        <div class="offcanvas-header">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img class="img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                            </a>
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#navbarUser"></button>
                        </div>
                        <div class="offcanvas-body">
                            @include('profile.partials.sidebar')
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-xl-8">
                    <div class="profile__content tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" role="tabpanel">
                            <div class="profile__content__header">
                                <h3>{{ __('profile.conversations') }}</h3>

                            </div>

                            @if($conversations->count() > 0)
                                <div class="conversation">
                                    <div class="conversation__body">
                                        <div class="conversation__body__aside">
                                            <div class="d-flex justify-content-between align-items-center p-3 pb-0">
                                                 <h4 class="section-head mb-0" style="font-size: 18px;">{{ __('profile.conversations') }}</h4>

                                                 <button class="main-button sm main-primary fill px-3" data-bs-toggle="modal" data-bs-target="#newChatModal" style="min-width: auto;">
                                                     <i class="bi bi-plus-lg"></i> {{ __('profile.new_conversation') }}

                                                 </button>
                                            </div>
                                            <form class="main-form p-3" action="#">
                                                <div class="form-group">
                                                    <label for="search">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M22 22L20 20" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </label>
                                                    <input class="form-control" id="search" type="text" placeholder="{{ __('profile.search') }}">

                                                </div>
                                            </form>
                                            <div class="conversation__list">
                                                @foreach($conversations as $conversation)
                                                    @php
                                                        $otherUser = $conversation->getOtherParticipant(auth()->user());
                                                        $unreadCount = $conversation->messages()
                                                            ->where('sender_id', '!=', auth()->id())
                                                            ->where('is_read', false)
                                                            ->count();
                                                        $isUnread = $unreadCount > 0 ? 'unread' : '';
                                                        $isOnline = $otherUser->status === 'online' ? 'online' : ''; 
                                                    @endphp
                                                    <div class="conversation__user {{ $isUnread }} {{ $isOnline }}" 
                                                         data-conversation-id="{{ $conversation->id }}"
                                                         onclick="loadConversation(this)">
                                                        <div class="conversation__user__img">
                                                            <img class="img-fluid" src="{{ $otherUser->getFirstMediaUrl('avatar') ?: asset('images/icons/user.webp') }}" alt="">
                                                        </div>
                                                        <div class="conversation__user__info">
                                                            <div class="info__row">
                                                                <h3 class="user-name">{{ $otherUser->name }}</h3>
                                                                @if($conversation->latestMessage)
                                                                    <p class="user-time">{{ $conversation->latestMessage->created_at->format('H:i') }}</p>
                                                                @endif
                                                            </div>
                                                            <div class="info__row">
                                                                <p class="user-message">
                                                                    {{ $conversation->latestMessage ? Str::limit($conversation->latestMessage->content, 30) : __('profile.start_conversation') }}

                                                                </p>
                                                                @if($unreadCount > 0)
                                                                    <div class="message-number">{{ $unreadCount }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="conversation__chat d-none" id="chatArea">
                                            <div class="conversation__collapsing">
                                                <div class="conversation__chat__head">
                                                    <div class="conversation__chat__head__user">
                                                        <div class="user__img online">
                                                            <img class="img-fluid" id="chatUserImage" src="" alt="">
                                                        </div>
                                                        <div class="user__info">
                                                            <div class="info__row">
                                                                <h3 class="user-name" id="chatUserName"></h3>
                                                            </div>
                                                            <div class="info__row">
                                                                <p class="user-status" id="chatUserStatus">online</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="section-buttons">
                                                    <button id="removeChat" type="button" class="btn p-0 me-2" data-bs-toggle="modal" data-bs-target="#deleteChatModal">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                    <button id="backToConversationsList" class="d-md-none">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15 19.9201L8.47997 13.4001C7.70997 12.6301 7.70997 11.3701 8.47997 10.6001L15 4.08008" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="conversation__chat__body" id="chatMessages">
                                                    <!-- Messages go here -->
                                                </div>
                                                <div class="conversation__chat__footer">
                                                    <form class="main-form emoji-picker-container" id="sendMessageForm" action="#">
                                                        <input type="hidden" id="currentConversationId">
                                                        <input class="form-control" id="messageInput" type="text" data-emojiable="true" name="message" placeholder="{{ __('profile.type_message') }}">

                                                    </form>
                                                    <button form="sendMessageForm" type="submit"> 
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.51002 4.23001L18.07 8.51001C21.91 10.43 21.91 13.57 18.07 15.49L9.51002 19.77C3.75002 22.65 1.40002 20.29 4.28002 14.54L5.15002 12.81C5.37002 12.37 5.37002 11.64 5.15002 11.2L4.28002 9.46001C1.40002 3.71001 3.76002 1.35001 9.51002 4.23001Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M5.44 12H10.84" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Empty State replaced by JS logic if needed, or kept simple initially hidden -->
                                        <div class="conversation__chat d-flex align-items-center justify-content-center" id="emptyChatState">
                                            <div class="profile__empty">
                                                <i class="bi bi-chat-dots fs-1 mb-3 d-block display-1 text-muted"></i>
                                                <h3 class="mt-3 text-muted">{{ __('profile.select_conversation_to_start') }}</h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="profile__empty">
                                    <img class="img-fluid" src="{{ asset('images/icons/conversations-empty.svg') }}" alt="Empty">
                                    <h3>{{ __('profile.no_conversations_yet') }}</h3>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delete Chat modal -->
    <div class="main-modal modal fade" id="deleteChatModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="section-head"> {{ __('profile.delete_conversation') }}</h4>

          </div>
          <div class="modal-body">
            <form class="main-form" id="deleteChatForm" action="#">
              <p class="section-text">{{ __('profile.confirm_delete_conversation') }}</p>

              <input type="text" name="idRemovedItem" value="" hidden>
            </form>
          </div>
          <div class="modal-footer">
            <button class="main-button main-primary fill" type="submit" form="deleteChatForm">{{ __('profile.confirm_delete') }}</button>

            <button class="main-button main-primary outline" type="button" data-bs-dismiss="modal">{{ __('profile.cancel_delete') }}</button>

          </div>
        </div>
      </div>
    </div>

    <!-- New Chat Modal -->
    <div class="main-modal modal fade" id="newChatModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="section-head">{{ __('profile.start_new_conversation') }}</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="main-form">
                        <!-- Step 1: User Type -->
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('profile.select_user_type') }}</label>

                            <select class="form-select" id="newChatUserType">
                                <option value="" disabled selected>{{ __('profile.select_type_placeholder') }}</option>

                                @foreach($userTypes as $type)
                                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Step 2: Search User -->
                        <div class="form-group mb-3 d-none" id="newChatUserSearchGroup">
                            <label class="form-label">{{ __('profile.search_user') }}</label>

                            <input type="text" class="form-control" id="newChatSearchInput" placeholder="{{ __('profile.type_name_to_search') }}">

                            
                            <div class="list-group mt-2" id="newChatSearchResults" style="max-height: 200px; overflow-y: auto;">
                                <!-- Results -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('styles')
<style>
    /* Robust Layout Fixes */
    .conversation__body {
        display: flex !important;
        flex-wrap: nowrap !important;
        /* Responsive height: fills viewport minus header/margins */
        height: calc(100vh - 180px) !important; 
        min-height: 600px !important;
        background: #fff;
        border-radius: 10px;
        overflow: hidden; /* Contains the scrollable areas */
        border: 1px solid #eef2f5;
        width: 100%;
        position: relative; /* Context for absolute children on mobile */
    }
    
    .conversation__body__aside {
        width: 350px !important;
        flex-shrink: 0;
        border-left: 1px solid #eef2f5; /* RTL separation */
        display: flex;
        flex-direction: column;
        height: 100% !important;
        background: #fff;
        z-index: 1;
    }

    .conversation__list {
        overflow-y: auto;
        flex: 1;
        height: 100%;
        max-height: none !important; /* Override explicit limits */
    }

    /* Desktop: Chat is side-by-side */
    .conversation__chat {
        flex-grow: 1;
        display: flex !important;
        flex-direction: column;
        height: 100% !important;
        background: #fff;
        /* Critical Overrides for Desktop */
        position: static !important; 
        transform: none !important;
        width: auto !important;
        inset: auto !important;
    }

    /* Fix: Ensure d-none always wins over the above !important display */
    .conversation__chat.d-none {
        display: none !important;
    }

    .conversation__chat__body {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: #f9f9f9;
        height: 100%;
        min-height: 0; /* Important for flex scrolling */
    }

    .conversation__chat__footer {
        padding: 15px;
        border-top: 1px solid #eef2f5;
        background: #fff;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
    }

    .conversation__collapsing {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
    }
    
    /* Empty State */
    #emptyChatState {
        display: flex !important;
        flex-grow: 1;
        width: auto !important;
        height: 100%;
        justify-content: center;
        align-items: center;
        position: static !important;
        transform: none !important;
    }

    #emptyChatState.d-none {
        display: none !important;
    }

    .profile__empty {
        text-align: center;
        color: #777;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .conversation__body {
            height: 80vh !important;
            min-height: 500px !important;
        }

        .conversation__body__aside {
            width: 100% !important;
            border-left: none;
            height: 100% !important;
            display: flex; /* Visible by default */
        }
        
        /* On mobile, Chat is absolute covering the aside */
        .conversation__chat, #emptyChatState {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            z-index: 10;
            background: #fff;
            transform: none !important; /* Managed by d-none logic */
        }

        /* Default state: Chat hidden */
        .conversation__chat {
            display: none !important;
        }
        
        .conversation__chat.active-chat {
            display: flex !important;
        }

        /* When chat is active, hide aside to ensure clean stack? 
           Or rely on z-index. JS hides aside to be safe. */
    }</style>
    @endpush

    @push('scripts')
        <script>
            // --- New Chat Logic ---
            // --- New Chat Logic ---
            $(document).ready(function() {
                const userTypeSelect = $('#newChatUserType');
                const searchGroup = $('#newChatUserSearchGroup');
                const searchInput = $('#newChatSearchInput');
                const resultsContainer = $('#newChatSearchResults');
                let searchTimeout = null;

                function fetchUsers(type, query = '') {
                    resultsContainer.html('<div class="text-center p-2 text-muted"><span class="spinner-border spinner-border-sm"></span> {{ __('profile.loading') }}</div>');

                    
                    $.ajax({
                        url: `/profile/search-users`,
                        data: { type: type, query: query },
                        success: function(users) {
                            if(users.length === 0) {
                                resultsContainer.html('<div class="list-group-item text-muted text-center">{{ __('profile.no_users_found') }}</div>');

                            } else {
                                let html = '';
                                users.forEach(user => {
                                    html += `
                                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-2" onclick="startNewChat(${user.id}, event)">
                                            <img src="${user.avatar_url}" class="rounded-circle" width="35" height="35" style="object-fit:cover;">
                                            <div>
                                                <div class="fw-bold">${user.name}</div>
                                            </div>
                                        </a>
                                    `;
                                });
                                resultsContainer.html(html);
                            }
                        },
                        error: function(err) {
                            console.error(err);
                            resultsContainer.html('<div class="text-danger text-center">{{ __('profile.error_occurred') }}</div>');

                        }
                    });
                }

                if(userTypeSelect.length) {
                    userTypeSelect.on('change', function() {
                        const type = $(this).val();
                        if(type) {
                            searchGroup.removeClass('d-none');
                            searchInput.val('');
                            // Fetch immediately
                            fetchUsers(type);
                        } else {
                            searchGroup.addClass('d-none');
                        }
                    });
                }

                if(searchInput.length) {
                    searchInput.on('keyup', function() {
                        const query = $(this).val().trim();
                        const type = userTypeSelect.val();
                        
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(() => {
                            fetchUsers(type, query);
                        }, 300);
                    });
                }
            });

            function startNewChat(userId, event) {
                event.preventDefault();
                
                // Show loading state on the clicked item
                const target = event.currentTarget;
                const originalContent = target.innerHTML;
                target.innerHTML = '<div class="text-center w-100"><span class="spinner-border spinner-border-sm"></span></div>';
                
                fetch('/profile/conversations/start', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ user_id: userId })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.conversation_id) {
                        // Close modal
                        const modalEl = document.getElementById('newChatModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();

                        window.location.reload(); 
                    } else if(data.error) {
                        alert(data.error);
                        target.innerHTML = originalContent;
                    }
                })
                .catch(err => {
                    console.error(err);
                    target.innerHTML = originalContent;
                });
            }
            // --- End New Chat Logic ---

            function setIdRemovedItem(id, element) {
        console.log('Set ID to remove:', id);
        const input = document.querySelector('input[name="idRemovedItem"]');
        if(input) input.value = id;
    }

    document.addEventListener('DOMContentLoaded', function() {
                // Search functionality (simple client-side filter)
                const searchInput = document.getElementById('search');
                if(searchInput) {
                    searchInput.addEventListener('keyup', function() {
                        const value = this.value.toLowerCase();
                        document.querySelectorAll('.conversation__user').forEach(user => {
                            const name = user.querySelector('.user-name').textContent.toLowerCase();
                            user.style.display = name.includes(value) ? '' : 'none';
                        });
                    });
                }
            });

            function loadConversation(element) {
                const conversationId = element.getAttribute('data-conversation-id');
                const chatArea = document.getElementById('chatArea');
                const emptyState = document.getElementById('emptyChatState');
                const messagesContainer = document.getElementById('chatMessages');
                const currentConversationInput = document.getElementById('currentConversationId');

                // Active class handling
                document.querySelectorAll('.conversation__user').forEach(el => el.classList.remove('active'));
                element.classList.add('active');

                // Show chat area
                chatArea.classList.remove('d-none');
                chatArea.classList.add('active-chat');
                chatArea.style.display = ''; 

                if(emptyState) {
                    emptyState.classList.add('d-none');
                    emptyState.classList.remove('d-flex');
                }

                // Mobile handling
                if (window.innerWidth < 768) {
                     document.querySelector('.conversation__body__aside').style.display = 'none';
                }

                currentConversationInput.value = conversationId;

                // Show loading state
                messagesContainer.innerHTML = '<div class="text-center p-5"><span class="spinner-border spinner-border-sm"></span> {{ __('profile.loading') }}</div>';


                // Fetch messages
                fetch(`/profile/conversations/${conversationId}/messages`)
                    .then(response => response.json())
                    .then(data => {
                        // Update header
                        document.getElementById('chatUserImage').src = data.otherUser.avatar_url;
                        document.getElementById('chatUserName').textContent = data.otherUser.name;
                        document.getElementById('chatUserStatus').textContent = data.otherUser.status || 'online'; // Assuming status or default

                        // Render messages
                        let html = '';
                        if(data.messages.length === 0) {
                             html = '<div class="text-center p-4 text-muted">{{ __('profile.no_messages_yet') }}</div>';

                        } else {
                            let lastDate = '';
                            data.messages.forEach(msg => {
                                const isSender = msg.sender_id === data.currentUser.id;
                                const msgClass = isSender ? 'sending' : 'incoming';
                                const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                                // Add date separator if needed (simple logic)
                                const msgDate = new Date(msg.created_at).toLocaleDateString();
                                if(msgDate !== lastDate) {
                                    html += `<div class="sticky-badge-date">${msgDate}</div>`;
                                    lastDate = msgDate;
                                }

                                // Check status icon (mock logic for now, or real if available)
                                const statusIcon = isSender 
                                    ? `<div class="status"><span class="${msg.is_read ? 'seen' : 'sended'}"><i class="bi bi-check2${msg.is_read ? '-all' : ''}"></i></span></div>` 
                                    : '';

                                html += `
                                    <div class="message ${msgClass}">
                                        <div class="message__content">${msg.content}</div>
                                        <div class="message__info">
                                            ${statusIcon}
                                            <div class="time">${time}</div>
                                        </div>
                                    </div>
                                `;
                            });
                        }
                        messagesContainer.innerHTML = html;
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        messagesContainer.innerHTML = '<div class="text-danger text-center p-3">{{ __('profile.error_loading_messages') }}</div>';

                    });
            }

            // Back button for mobile
            const backBtn = document.getElementById('backToConversationsList');
            if(backBtn) {
                backBtn.addEventListener('click', function() {
                    const chatArea = document.getElementById('chatArea');
                    chatArea.classList.remove('active-chat');
                    chatArea.classList.add('d-none');
                    document.querySelector('.conversation__body__aside').style.display = 'block';

                     // Optional: Show empty state again if desired, or keep hidden
                });
            }

            // Send Message
            document.getElementById('sendMessageForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const conversationId = document.getElementById('currentConversationId').value;
                const input = document.getElementById('messageInput');
                const message = input.value;
                const messagesContainer = document.getElementById('chatMessages');

                if (!message.trim()) return;

                // Optimistic UI (add message immediately)
                const tempId = Date.now();
                const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const tempHtml = `
                    <div class="message sending" id="msg-${tempId}">
                        <div class="message__content">${message}</div>
                        <div class="message__info">
                             <div class="status"><span class="sended"><i class="bi bi-clock"></i></span></div>
                             <div class="time">${time}</div>
                        </div>
                    </div>
                `;
                // Remove empty message warning if exists
                const emptyMsg = messagesContainer.querySelector('.text-center.text-muted');
                if(emptyMsg) emptyMsg.remove();

                messagesContainer.insertAdjacentHTML('beforeend', tempHtml);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                input.value = '';

                fetch(`/profile/conversations/${conversationId}/messages`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update status icon
                        const msgEl = document.getElementById(`msg-${tempId}`);
                        if(msgEl) {
                            msgEl.querySelector('.status span').innerHTML = '<i class="bi bi-check2"></i>';
                            msgEl.querySelector('.status span').className = 'sended';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    const msgEl = document.getElementById(`msg-${tempId}`);
                     if(msgEl) {
                        msgEl.querySelector('.status span').innerHTML = '<i class="bi bi-exclamation-circle"></i>';
                        msgEl.querySelector('.status span').className = 'error';
                    }
                });
            });
        </script>
    @endpush
@endsection
